<?php

use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\UserController;
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

