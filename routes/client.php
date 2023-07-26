<?php


use App\Http\Controllers\Client\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest.client')->prefix('client')->group(function () {

    Route::get('login', [AuthController::class, 'loginFormShow'])
                ->name('client.loginForm');

    Route::post('login', [AuthController::class, 'login'])->name('client.login');

});

Route::middleware('auth:client')->prefix('client')->group(function () {

    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->middleware(['auth', 'verified'])->name('client.dashboard');
    Route::post('logout', [AuthController::class, 'logout'])
                ->name('client.logout');
});
