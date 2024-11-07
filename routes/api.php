<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::name("auth.")->prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get("/me", [AuthController::class, 'me'])->name("me");
    });

    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->except(['create', 'edit']);

    Route::resource('clients', \App\Http\Controllers\ClientController::class)
        ->except(['create', 'edit']);


});

