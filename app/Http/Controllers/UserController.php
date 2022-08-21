<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserPasswordUpdate;
use App\Http\Requests\User\UserProfileUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('media.model')->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // n+1 problem
        $user = User::with('media.model')->find($user->id);
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileUpdate $request, User $user)
    {
        $user->update($request->only('name', 'email'));
        if($request->hasFile('avatar')){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
            $user->getMedia('avatar')->count();
            $user->getFirstMediaUrl('avatar'); 
        }
        toast()->success('Successed','User profile updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast()->success('Successed','User deleted successfully');
        return back();
    }

    public function updatePassword(UserPasswordUpdate $request,$id)
    {
        $user = User::findorFail($id);
        if(!Hash::check($request->old_password, $user->password)){
            toast()->error('Failed','Old password is not correct');
            return back();
        }
        $user->update(['password' => bcrypt($request->password)]);
        $user->save();
        toast()->success('Successed','User password updated successfully');
        return back();
    }
}
