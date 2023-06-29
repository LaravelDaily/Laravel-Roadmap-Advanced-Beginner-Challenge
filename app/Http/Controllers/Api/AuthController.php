<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
           'email' => 'required|email|max:255|min:6|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken($request->name)->plainTextToken;

        $admin = User::find(1);

        $admin->notify(new UserRegistered($user));

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            abort(404,"Login Credientials Does Not Match");
        }

        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);

    }

    public function logout(Request $request)
    {
       $request->user()->currentAccessToken()->delete();
       return response([
           'message' => 'You have logged Out'
       ], 200);
    }
}
