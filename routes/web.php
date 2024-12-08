<?php

use App\Models\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("scramble.docs.ui");
});
