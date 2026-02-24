<?php

use Illuminate\Support\Facades\Route;

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
