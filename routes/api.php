<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\TransactionsController;

//Discovery Routes
Route::get("/", function () {
    return response()->json([
        "message" => "Welcome to Money Tracker API",
        "version" => "1.0.0",
        "endpoints" => [
            [
                "method" => "GET",
                "uri" => "/api/health",
                "description" => "Check API health status",
            ],
            [
                "method" => "POST",
                "uri" => "/api/login",
                "description" => "Authenticate user",
            ],
            [
                "method" => "GET",
                "uri" => "/api/profile",
                "description" => "Get authenticated user profile",
            ],
            [
                "method" => "POST",
                "uri" => "/api/register",
                "description" => "Register a new user",
            ],
            [
                "method" => "POST",
                "uri" => "/api/transactions",
                "description" => "Create a transaction",
            ],
            [
                "method" => "POST",
                "uri" => "/api/wallet",
                "description" => "Create a wallet",
            ],
            [
                "method" => "GET",
                "uri" => "/api/wallet",
                "description" => "List user wallets",
            ],
            [
                "method" => "GET",
                "uri" => "/api/wallet/{wallet}",
                "description" => "Get a specific wallet by ID",
            ],
        ],
    ]);
});

Route::get("/health", function (Request $request) {
    return response()->json(["status" => "OK"]);
});

// Authentication Routes
Route::controller(User::class)->group(function () {
    Route::post("/register", "create");
    Route::post("/login", "login");
});

// Authorization Routes
Route::middleware(["api.auth"])->group(function () {
    Route::controller(WalletsController::class)
        ->prefix("wallet")
        ->group(function () {
            Route::post("/", "create");
            Route::get("/", "index");
            Route::get("/{wallet}", "show");
        });

    Route::controller(User::class)->group(function () {
        Route::get("/profile", "index");
    });

    Route::controller(TransactionsController::class)->group(function () {
        Route::post("/transactions", "create");
    });
});
