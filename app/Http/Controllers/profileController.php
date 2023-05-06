<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class profileController extends Controller
{
public function show($id){
    try {
        $user=User::findOrFail($id);

    }catch (ModelNotFoundException $exception){
        return view('users.notfound')->with('error','sorry this user not found in our DB') ;
    }

    return view('users.profile',compact('user'));

}
public function editprofileimage(User $user){
    $this->authorize('editprofileimage',[Profile::class,$user->id]);

    return view('users.editprofileimage',compact('user'));
}
public function store(Request $request,User $user){
    $this->authorize('editprofileimage',[Profile::class,$user->id]);

    if(auth()->user() and Request('profile_image')){
        auth()->user()->addMediaFromRequest('profile_image')->toMediaCollection('profiles_image');
        return redirect()->back();
    }
}

}
