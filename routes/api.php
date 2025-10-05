<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/check', function (Request $request) {
    return response()->json(['message' => 'API route working!']);
});