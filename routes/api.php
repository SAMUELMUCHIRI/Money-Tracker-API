<?php

use Couchbase\UserManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\WalletsController;
use App\Http\Controllers\TransactionsController;

Route::controller(User::class)->group(function () {
    Route::post("/register", "create");
    Route::post("/login", "login");
});

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

Route::get("/health", function (Request $request) {
    return response()->json(["status" => "OK"]);
});
