<?php

use Illuminate\Support\Facades\Route;

Route::name("auth.")->prefix('/auth')->group(function () {
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/login', 'AuthController@login')->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'AuthController@logout')->name('logout');
        Route::get("/me", "AuthController@me")->name("me");
    });
});
