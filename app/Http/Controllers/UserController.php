<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UserPasswordUpdate;
use App\Http\Requests\User\UserProfileUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('media.model','roles')->paginate(10);
        return view('pages.users.index', compact('users'));
    }


    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($request->hasFile('avatar')){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        $user->assignRole('user');
        toast()->success('Successed','User Created Successfully');
        return redirect()->route('users.index');
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
        // without transaction it deletes role for the user before 
        // checking if the user related to any task or project
        DB::beginTransaction();
        try {
            $user->delete();
            toast()->success('Successed','User deleted successfully');
            DB::commit();
        } 
        catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            toast()->error('Failed','User can not be deleted, because it is related Project or Task');
        }
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
