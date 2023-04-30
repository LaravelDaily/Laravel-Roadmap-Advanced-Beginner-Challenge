<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (!auth()->attempt($validatedData)) {
            return response()->json([
                'message' => 'Credential not match',
                'errors' => [
                    'password' => [
                        'Invalid credantials'
                    ],
                ],
            ], 422);
        }

        $user = User::where('email', $validatedData['email'])->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;
        
        return response()->json([
            'access_token' => $authToken
        ]); 
    }
}
