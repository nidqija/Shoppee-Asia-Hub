<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class AuthController extends Controller
{
    public function signup(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:central.users,email',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|unique:central.users,phone_number',
            'home_region' => 'required|string',
            'role' => 'required|string|in:seller,user',

        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone_number' => $validated['phone_number'],
            'home_region' => strtoupper($validated['home_region']),
            'role' => $validated['role'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],

        ], 201); // status code 201 for resource creation




    }


    public function signin(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !\Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 401); // status code 401 for unauthorized
        } 


        Auth::login($user);
        $request->session()->regenerate();
        $token = $user -> createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);


       
    }
}
