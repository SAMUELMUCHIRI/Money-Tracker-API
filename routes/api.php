<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;

Route::controller(User::class)->group(function () {
    Route::post("/register", "create");
    Route::post("/login", "login");
});

Route::get("/health", function (Request $request) {
    return response()->json(["status" => "OK"]);
});
