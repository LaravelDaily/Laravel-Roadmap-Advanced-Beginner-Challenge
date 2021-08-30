<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param Request $request
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('Personal token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json([$response], 201);
    }

    /**
     * Login a user
     *
     * @param Request $request
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (! $user || ! Hash::check($fields['password'], $user->password)) {
            return response()->json(['message' => 'Something goes wrong...'], 401);
        }

        $token = $user->createToken('Personal token')->plainTextToken;

        return response()->json($token, 201);
    }

    /**
     * Logout a user
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully. See you soon!'], 201);
    }
}
