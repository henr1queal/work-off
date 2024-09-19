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

    private function validateSignature(Request $request)
    {
        $mpToken = env('MERCADO_PAGO_ACCESS_TOKEN');

        $receivedSignature = $request->header('X-Mercadopago-Signature');

        if (!$receivedSignature || $receivedSignature !== hash_hmac('sha256', $request->getContent(), $mpToken)) {
            Log::error('Assinatura inválida do webhook do Mercado Pago');
            abort(403, 'Assinatura inválida');
        }
    }

    public function webhook(Request $request)
    {
        Log::info('chegou aqui');
        $this->validateSignature($request);

        $payment_id = isset($request->data['id']) ? $request->data['id'] : null;

        $user = User::with(['plans' => function ($query) use ($payment_id) {
            $query->where('external_reference', $payment_id);
        }])->first();

        Log::info('passou aqui');
        if (!$user) {
            return;
        }
        
        try {
            DB::beginTransaction();
            Log::info('teste');
            $access_token = env('MP_ACCESS_TOKEN');
            $unique_id = uniqid();
            MercadoPagoConfig::setAccessToken($access_token);
            $request_options = new RequestOptions();
            $request_options->setCustomHeaders(["X-Idempotency-Key: {$unique_id}"]);
            
            Log::info('xd');
            $client = new PaymentClient();
            $payment = $client->get($payment_id, $request_options);
            if ($payment->status === 'approved') {
                if ($payment->external_reference == 1) {
                    $new_time = now()->addDays(30);
                } else if ($payment->external_reference == 2) {
                    $new_time = now()->addDays(90);
                } else {
                    $new_time = now()->addDays(365);
                }
                
                DB::table('plan_user')
                ->where('external_reference', $payment_id)->update(['expires_at' => $new_time, 'updated_at' => now()]);
                Log::info('aaa');
                
                Mail::to($user->email)->send(new PlanPaid());
                Log::info('email');
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
}
