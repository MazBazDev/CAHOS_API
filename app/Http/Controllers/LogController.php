<?php

namespace App\Http\Controllers;

use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        activity("Read", "Logs read.");
        return response()->json(Log::orderBy("created_at", "desc")->get());
    }
}
