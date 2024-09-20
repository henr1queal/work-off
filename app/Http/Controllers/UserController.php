<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Phone;
use App\Models\Pix;
use App\Models\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::with(['phones', 'pix', 'instagram'])
            ->findOrFail($id);

        // Verifica se o usuário tem planos com expires_at > now
        $hasValidPlans = $user->plans()->where('expires_at', '>', now())->exists();

        $name = $user->name;
        // Retorna a view com os dados do usuário e o nome
        if($hasValidPlans) {
            return view('user', compact(['user', 'name']));
        } else {
            return view('user', compact('name'));
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'message' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'first_phone' => 'required|string|size:14',
            'first_phone_type' => 'required|in:0,1',
            'seccond_phone' => 'nullable|string|size:14',
            'seccond_phone_type' => 'nullable|in:0,1',
            'instagram' => 'nullable|string|max:255',
            'pix' => 'nullable|string|max:255',
            'plan' => 'required|in:1,2,3',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $timestamp = now()->timestamp;
                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = $timestamp . '.' . $extension;
                $request->file('image')->storeAs('', $filename, 'public');
                $imageUrl = $filename;
            } else {
                $imageUrl = null;
            }

            $user = User::where('email', $request->email)->first();

            if ($user) {
                $plan = $user->plans->last();
                if ($plan) {
                    $plan = $user->plans->last()->pivot;

                    if ($plan->expires_at > now()) {
                        return redirect()->route('user', $user->id);
                    };

                    if ($plan->expires_at === null && $plan->external_reference === null) {
                        $user->update([
                            'name' => $request->input('name'),
                            'birthdate' => $request->input('birthdate'),
                            'message' => $request->input('message'),
                            'image' => $imageUrl
                        ]);
                    }

                    if ($plan->expires_at !== null && $plan->expires_at < now()) {
                        $user->plans()->attach($request->plan, ['created_at' => now()]);
                    }

                    // Atualizar ou criar Phone
                    if ($request->filled('first_phone')) {
                        $phone1 = $user->phones()->firstOrNew(['phone' => $request->input('first_phone')]);
                        $phone1->is_whatsapp = $request->input('first_phone_type');
                        $phone1->save();
                    }

                    if ($request->filled('seccond_phone')) {
                        $phone2 = $user->phones()->firstOrNew(['phone' => $request->input('seccond_phone')]);
                        $phone2->is_whatsapp = $request->input('seccond_phone_type');
                        $phone2->save();
                    }

                    // Deletar Phones se não estiverem no request
                    if (!$request->filled('first_phone')) {
                        $user->phones()->where('phone', $request->input('first_phone'))->delete();
                    }

                    if (!$request->filled('seccond_phone')) {
                        $user->phones()->where('phone', $request->input('seccond_phone'))->delete();
                    }

                    // Atualizar ou criar Instagram
                    if ($request->filled('instagram')) {
                        $instagram = $user->instagram()->firstOrNew();
                        $instagram->username = str_replace('@', '', $request->input('instagram'));
                        $instagram->save();
                    } else {
                        // Deletar Instagram se não estiver no request
                        $user->instagram()->delete();
                    }

                    // Atualizar ou criar Pix
                    if ($request->filled('pix')) {
                        $pix = $user->pix()->firstOrNew();
                        $pix->key = $request->input('pix');
                        $pix->save();
                    } else {
                        // Deletar Pix se não estiver no request
                        $user->pix()->delete();
                    }
                }
                $user->plans()->attach($request->plan, ['created_at' => now()]);
            } else {
                // Criar novo usuário e associar plano
                $user = User::create([
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'birthdate' => $request->input('birthdate'),
                    'message' => $request->input('message'),
                    'image' => $imageUrl
                ]);
                $user->plans()->attach($request->plan, ['created_at' => now()]);

                // Criar novos registros de Phone, Instagram, e Pix
                if ($request->filled('first_phone')) {
                    $phone1 = new Phone();
                    $phone1->user_id = $user->id;
                    $phone1->phone = $request->input('first_phone');
                    $phone1->is_whatsapp = $request->input('first_phone_type');
                    $phone1->save();
                }

                if ($request->filled('seccond_phone')) {
                    $phone2 = new Phone();
                    $phone2->user_id = $user->id;
                    $phone2->phone = $request->input('seccond_phone');
                    $phone2->is_whatsapp = $request->input('seccond_phone_type');
                    $phone2->save();
                }

                if ($request->filled('instagram')) {
                    $instagram = new Instagram();
                    $instagram->user_id = $user->id;
                    $instagram->username = str_replace('@', '', $request->input('instagram'));
                    $instagram->save();
                }

                if ($request->filled('pix')) {
                    $pix = new Pix();
                    $pix->user_id = $user->id;
                    $pix->key = $request->input('pix');
                    $pix->save();
                }
            }

            DB::commit();
            return redirect()->route('payment.checkout', [
                'user_id' => $user->id,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            // Remover a imagem carregada se algo der errado
            if (isset($imagePath) && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            dd($th->getMessage());
            return redirect()->route('faq')->with('error', 'Erro.');
            Log::error('Erro ao criar usuário: ' . $th->getMessage(), ['exception' => $th]);
        }
    }
}
