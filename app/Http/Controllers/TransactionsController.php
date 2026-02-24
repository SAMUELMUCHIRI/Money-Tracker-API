<?php

namespace App\Http\Controllers;

use App\Models\Wallets;
use Illuminate\Http\Request;
use App\Models\Transactions;

use Illuminate\Support\Facades\DB;
class TransactionsController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            "type" => "required|string|in:income,expense",
            "amount" => "required|integer|min:0.01",
            "description" => "required|string|min:4",
            "wallet_name" => "required|string|min:3",
        ]);

        $wallet = DB::table("Wallets")
            ->select("id")
            ->where("name", $validated["wallet_name"])
            ->where("user_id", auth("sanctum")->id())
            ->first();
        if (!$wallet) {
            return response()->json(["error" => "Wallet not found"], 404);
        }

        $transaction = new Transactions([
            "type" => $validated["type"],
            "amount" => $validated["amount"],
            "description" => $validated["description"],
            "wallet_id" => $wallet->id,
        ]);

        if ($transaction->type === "expense") {
            DB::table("Wallets")
                ->where("id", $wallet->id)
                ->decrement("balance", $validated["amount"]);
        } else {
            DB::table("Wallets")
                ->where("id", $wallet->id)
                ->increment("balance", $validated["amount"]);
        }

        $transaction->save();

        return response()->json($transaction, 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Transactions $Transactions)
    {
        //
    }

    public function edit(Transactions $Transactions)
    {
        //
    }

    public function update(Request $request, Transactions $Transactions)
    {
        //
    }

    public function destroy(Transactions $Transactions)
    {
        //
    }
}
