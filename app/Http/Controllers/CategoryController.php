<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello World'
        ]);
    }
}
