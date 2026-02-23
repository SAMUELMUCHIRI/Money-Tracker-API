<?php

namespace App\Http\Controllers;

use App\Models\Wallets as UserWallet;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class WalletsController extends Controller
{
    public function index()
    {
        $wallets = DB::table("Wallets")
            ->select("name", "description", "balance", "created_at")
            ->where("user_id", auth("sanctum")->id())
            ->get();
        return response()->json(
            [
                "Message" => "Wallets retrieved successfully",
                "errors" => false,
                "data" => $wallets,
            ],
            200,
        );
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|min:2|max:255",
                "description" => "required|string|min:5",
            ]);

            $new_wallet = new UserWallet();
            $new_wallet->user_id = auth("sanctum")->id();
            $new_wallet->name = $request->name;
            $new_wallet->description = $request->description;
            $new_wallet->save();

            return response()->json(
                [
                    "Message" => "Created Wallet Succesfully",
                    "errors" => false,
                ],
                200,
            );
        } catch (ValidationException $e) {
            return response()->json(
                [
                    "message" => "Validation failed",
                    "errors" => $e->errors(),
                ],
                422,
            );
        }
    }

    public function show($wallet, Request $request)
    {
        $userWallet = DB::table("Wallets")
            ->where("user_id", auth("sanctum")->id())
            ->where("name", $wallet)
            ->get();

        if ($userWallet->isEmpty()) {
            return response()->json(
                [
                    "message" => "Forbidden",
                    "error" => "You do not own this wallet",
                ],
                403,
            );
        }

        return response()->json(
            [
                "message" => "Forbidden",
                "return" => $userWallet,
            ],
            200,
        );
    }
}
