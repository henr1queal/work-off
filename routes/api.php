<?php

use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\UserController;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/processar-pagamento/{user_id}', [MercadoPagoController::class, 'process'])->name('payment.process');
// Route::post('/webhook', [MercadoPagoController::class, 'webhook'])->name('webhook');
Route::post('/mercado-pago-webhook', [MercadoPagoController::class, 'webhook'])->name('webhook');
Route::get('/teste', function () {
    $payment_id = 1326933315;
    $planWithUser = Plan::whereHas('users', function ($query) use ($payment_id) {
        $query->where('external_reference', $payment_id);
    })
        ->with(['users' => function ($query) use ($payment_id) {
            $query->where('external_reference', $payment_id)
                // ->whereNull('expires_at') // Verifica se expires_at é nulo
                ->orderBy('plan_user.created_at', 'desc')
                ->limit(1);
        }])
        ->first();

    $user = $planWithUser->users->first();
    // dd($user->name);
    $pivotData = $user->pivot;
    dd($pivotData->expires_at);
    dd($pivotData);
    dd($planWithUser->pivot);
})->name('teste');
