<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return response()->json(['message' => 'User registered successfully']);
        } catch (\Exception $e) {
            // return response()->json(['User registered unsuccessfully'], 500);
            return response()->json([$e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if (!Auth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $user = $request->user();
            $token = $user->createToken('app-token')->plainTextToken;

            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
