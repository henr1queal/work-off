<?php

use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('lp');
})->name('home');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/teste', function () {
    return view('lp');
})->name('lp');

Route::get('/qr-code/{user_id}/{status?}', [UserController::class, 'show'])->name('user');

Route::get('/efetuar-pagamento/{user_id}', [MercadoPagoController::class, 'checkout'])->name('payment.checkout');

Route::post('/new-user', [UserController::class, 'store'])->name('new-user');
