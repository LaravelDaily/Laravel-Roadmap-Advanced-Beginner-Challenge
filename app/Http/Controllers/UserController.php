<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::all();

        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     */
    public function edit(User $user)
    {
        if (!$user){
            return redirect('users')->with('error', 'This user doesn\'t exists');
        }

        $roles = Role::all();

        return view('user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEditRequest  $userEditRequest
     * @param  User $user
     */
    public function update(UserEditRequest $userEditRequest, User $user)
    {
        $validated = $userEditRequest->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->assignRole($validated['role']);
        $user->save();

        return redirect('users')->with('message', 'User edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     */
    public function destroy(User $user)
    {
        if (!$user){
            return redirect('users')->with('error', 'This user doesn\'t exists');
        }

        $user->delete();

        return redirect('users')->with('message', 'User deleted successfully');
    }
}
