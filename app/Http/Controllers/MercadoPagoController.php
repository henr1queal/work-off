<?php

namespace App\Http\Controllers;

use App\Mail\PlanPaid;
use App\Models\Plan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoController extends Controller
{
    public function checkout(Request $request, $user_id)
    {
        $plan = DB::table('plan_user')
            ->join('plans', 'plan_user.plan_id', '=', 'plans.id')
            ->where('plan_user.user_id', $user_id)
            ->select('plan_user.*', 'plans.*')
            ->orderByDesc('plan_user.created_at')
            ->first();

        try {
            $access_token = env('MP_ACCESS_TOKEN');
            $public_key = env('MP_PUBLIC_KEY');

            MercadoPagoConfig::setAccessToken($access_token);
            $preference = new PreferenceClient();
            $client = $preference->create([
                "items" => array(
                    array(
                        "title" => $plan->days === 30 ? "01 mês ($plan->days dias)" : ($plan->days === 2 ? "03 meses ($plan->days dias)" : "12 meses ($plan->days dias)"),
                        "quantity" => 1,
                        "unit_price" => $plan->price,
                    )
                )
            ]);
            $client->payment_methods = array(
                "installments" => 2
            );
            return view('payment', [
                'preference' => $client,
                'public_key' => $public_key,
                'user_id' => $user_id,
                'price' => $plan->price
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    public function process(Request $request, $user_id)
    {
        $choosedPlan = DB::table('plan_user')
            ->join('plans', 'plan_user.plan_id', '=', 'plans.id')
            ->where('plan_user.user_id', $user_id)
            ->where('plan_user.external_reference', null)
            ->select('plan_user.*', 'plans.*')
            ->orderBy('plan_user.created_at')
            ->first();

        if (!$choosedPlan) {
            throw new Exception("Erro ao selecionar usuário.", 404);
        }

        $access_token = env('MP_ACCESS_TOKEN');
        MercadoPagoConfig::setAccessToken($access_token);
        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $unique_id = uniqid();
        $request_options->setCustomHeaders(["X-Idempotency-Key: {$unique_id}"]);

        try {
            if ($request->payment_method_id === 'pix') {
                $payment = $this->pix($client, $request, $request_options, $choosedPlan);
            } else if ($request->payment_method_id === 'bolbradesco' || $request->payment_method_id === 'pec') {
                $payment = $this->ticket($client, $request, $request_options, $choosedPlan);
            } else {
                $payment = $this->card($client, $request, $request_options, $choosedPlan);
            }

            $get = DB::table('plan_user')
                ->where('external_reference', null)->where('plan_id', $choosedPlan->id)->where('plan_user.user_id', $user_id)->update(['external_reference' => $payment->id, 'updated_at' => now()]);


            return response()->json($payment);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Tente efetuar o pagamento novamente.');
        }
    }

    private function pix($client, $request, $request_options, $choosedPlan)
    {
        try {
            $payment = $client->create([
                "transaction_amount" => (float) $request->transaction_amount,
                "description" => $choosedPlan->days . ' dias',
                "payment_method_id" => $request->payment_method_id,
                "external_reference" => $choosedPlan->id,
                'notification_url' => route('webhook'),
                "payer" => [
                    "email" => $request->payer['email'],
                ]
            ], $request_options);

            return $payment;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }

    private function card($client, $request, $request_options, $choosedPlan)
    {
        try {
            $payment = $client->create([
                "transaction_amount" => (float) $request->transaction_amount,
                "token" => $request->token,
                "installments" => $request->installments,
                "description" => $choosedPlan->days . ' dias',
                "payment_method_id" => $request->payment_method_id,
                "external_reference" => $choosedPlan->id,
                "issuer_id" => $request->issuer_id,
                'notification_url' => route('webhook'),
                "payer" => [
                    "email" => $request->payer['email'],
                    "identification" => [
                        "type" => $request->payer['identification']['type'],
                        "number" => $request->payer['identification']['number']
                    ]
                ]
            ], $request_options);

            return $payment;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    private function ticket($client, $request, $request_options, $choosedPlan)
    {
        $payment = $client->create([
            "transaction_amount" => (float) $request->transaction_amount,
            "issuer_id" => $request->issuer_id,
            "description" => $choosedPlan->days . ' dias',
            "payment_method_id" => $request->payment_method_id,
            "external_reference" => $choosedPlan->id,
            'notification_url' => route('webhook'),
            "payer" => [
                "email" => $request->payer['email'],
                "first_name" => $request->payer['first_name'],
                "last_name" => $request->payer['last_name'],
                "identification" => [
                    "type" => $request->payer['identification']['type'],
                    "number" => $request->payer['identification']['number']
                ],
                "address" => [
                    "zip_code" => $request->payer["address"]['zip_code'],
                    "street_name" => $request->payer["address"]['street_name'],
                    "street_number" => $request->payer["address"]['street_number'],
                    "neighborhood" => $request->payer["address"]['neighborhood'],
                    "city" => $request->payer["address"]['city'],
                    "federal_unit" => $request->payer["address"]['federal_unit']
                ]
            ]
        ], $request_options);

        return $payment;
    }

    public function webhook(Request $request)
    {

        // Validação da assinatura
        $this->validateSignature($request);

        // Obter o ID do pagamento a partir da requisição
        $payment_id = isset($request->data['id']) ? $request->data['id'] : null;

        // Verifica se o ID do pagamento está presente
        if (!$payment_id) {
            return response()->json(['message' => 'ID de pagamento não encontrado'], 400);
        }

        $planWithUser = Plan::whereHas('users', function ($query) use ($payment_id) {
            $query->wherePivot('external_reference', $payment_id);
        })
            ->with(['users' => function ($query) use ($payment_id) {
                $query->wherePivot(['external_reference' => $payment_id, 'expires_at' => null])
                    ->orderBy('plan_user.created_at', 'desc')
                    ->limit(1);
            }])
            ->first();

        $user = $planWithUser->users->first();
        $pivotData = $user->pivot;

        if (!$user) {
            return;
        }

        try {
            DB::beginTransaction();

            $access_token = env('MP_ACCESS_TOKEN');
            $unique_id = uniqid();
            MercadoPagoConfig::setAccessToken($access_token);
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: {$unique_id}"]);

            $client = new PaymentClient();
            $payment = $client->get($payment_id, $request_options);

            // Verificação se o pagamento foi aprovado
            if ($payment->status === 'approved') {
                // Define o tempo de renovação do plano baseado no external_reference
                if ($payment->external_reference == 1) {
                    $new_time = now()->addDays(30);
                } else if ($payment->external_reference == 2) {
                    $new_time = now()->addDays(90);
                } else {
                    $new_time = now()->addDays(365);
                }

                $pivotData->expires_at = $new_time;
                $pivotData->updated_at = now();
                $pivotData->save();

                Mail::to($user->email)->send(new PlanPaid());

                DB::commit();
            } else {
                Log::info('Pagamento não aprovado: ' . $payment->status);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Erro ao processar o pagamento: ' . $th->getMessage());
        }
    }

    private function validateSignature(Request $request)
    {
        $xSignature = $request->header('X-Signature');
        $xRequestId = $request->header('X-Request-Id');
        $queryParams = $request->query();

        $dataID = isset($queryParams['data_id']) ? $queryParams['data_id'] : '';

        // Separar a assinatura
        $parts = explode(',', $xSignature);
        $ts = null;
        $hash = null;

        foreach ($parts as $part) {
            $keyValue = explode('=', $part, 2);
            if (count($keyValue) == 2) {
                $key = trim($keyValue[0]);
                $value = trim($keyValue[1]);
                if ($key === "ts") {
                    $ts = $value;
                } elseif ($key === "v1") {
                    $hash = $value;
                }
            }
        }


        $secret = env('MP_SECRET');

        $manifest = "id:$dataID;request-id:$xRequestId;ts:$ts;";

        $sha = hash_hmac('sha256', $manifest, $secret);

        if ($sha !== $hash) {
            abort(403, 'Assinatura inválida');
        }
    }
}
