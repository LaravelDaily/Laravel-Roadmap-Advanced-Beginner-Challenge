<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($request->all());

        $admin = User::find(1);

        $admin->notify(new UserRegistered($user));

        return response([
            'message' => 'Admin Created a User',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::findorFail($id);
        } catch (\Throwable $th) {
            abort(404, 'User Not Found');
        }
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'email|string|max:255',
        ]);

        $user = User::where('id', $id)->first();

        $user->update($request->all());

        return [
            'message' => 'User Credientials Updated'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findorFail($id);
        } catch (\Throwable $th) {
            abort(404, 'User Not Found');
        }

        $user->delete();

        return response([
            'message' => 'User Deleted'
        ]);
    }
}
