<?php


use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest.admin')->prefix('admin')->group(function () {

    Route::get('login', [AuthController::class, 'loginFormShow'])
                ->name('admin.loginForm');

    Route::post('login', [AuthController::class, 'login'])->name('admin.login');

});

Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('admin.dashboard');
    Route::post('logout', [AuthController::class, 'logout'])
                ->name('admin.logout');
});
