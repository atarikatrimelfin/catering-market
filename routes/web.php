<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registered', [AuthController::class, 'registered'])->name('registered');

Route::get('/dashboard', [LandingController::class, 'dashboard']);
Route::get('/profile', [LandingController::class, 'profile']);

Route::prefix("menu")->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('add', [MenuController::class, 'create']);
    Route::post('store', [MenuController::class, 'store']);
    Route::get('edit/{id}', [MenuController::class, 'edit']);
    Route::post('update/{id}', [MenuController::class, 'update']);
    Route::delete('delete/{id}', [MenuController::class, 'delete']);
});

Route::prefix("order")->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('add', [OrderController::class, 'create']);
    Route::post('store', [OrderController::class, 'store']);
    Route::get('edit/{id}', [OrderController::class, 'edit']);
    Route::post('update/{id}', [OrderController::class, 'update']);
    Route::delete('delete/{id}', [OrderController::class, 'delete']);
});
