<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                "email" => "required|email|max:255",
                "password" => "required|string|min:8",
            ]);

            if (!Auth::attempt($validated)) {
                return response()->json(
                    ["message" => "Invalid credentials"],
                    401,
                );
            }

            $token = $request->user()->createToken("api-client-token")
                ->plainTextToken;

            return response()->json(
                [
                    "token" => $token,
                    "user" => $request->user(),
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
    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                "name" => "required|string|min:3",
                "email" => "required|email|unique:users|max:255",
                "password" => "required|string|min:8",
            ]);

            $current_user = new AppUser();

            $current_user->name = $request->name;
            $current_user->email = $request->email;
            $current_user->password = $request->password;

            $current_user->save();

            return response()->json(
                [
                    "message" => "User Created Succesfully",
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
