<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use \Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('viewAny', User::class);
        $users = User::paginate(5);
        $usersTrashed = User::onlyTrashed()->get();
        return view('panel.users.index', compact('users', 'usersTrashed', 'unreadNotifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('create', User::class);
        $usersTrashed = User::onlyTrashed()->get();
        return view('panel.users.create', compact('usersTrashed', 'unreadNotifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create($request->all());
        $admin = User::find(1);

        $admin->notify(new UserRegistered($user));

        return redirect()->route('users.index')->with('msg', 'User Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('view', [User::class, $user]);
        $usersTrashed = User::onlyTrashed()->get();
        return view('panel.users.show', compact('user', 'usersTrashed', 'unreadNotifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('update', [User::class, $user]);
        $usersTrashed = User::onlyTrashed()->get();
        return view('panel.users.edit', compact('user', 'usersTrashed', 'unreadNotifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', [User::class, $user]);
        $request->validate([
            'name' => 'string',
            'email' => 'email|string|max:255',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('users.index')->with('msg', 'User Credientials Updated');
    }



    public function trash()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('restore', User::class);
        $users = User::onlyTrashed()->paginate(6);
        $usersTrashed = User::onlyTrashed()->get();
        return view('panel.users.trash', compact('users', 'usersTrashed', 'unreadNotifications'));
    }


    public function restore(User $user)
    {
        $this->authorize('restore', User::class);
        if ($user->trashed()) {
            $user->restore();
            return redirect()->route('users.index')->with('msg', 'User Account Restore');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', [User::class, $user]);
        if ($user->hasRole('admin')) {
            return redirect()->route('users.index')->with('msg', 'Admin Account Cannot Be  Suspended');
        } else {
            if ($user->trashed()) {
                $user->forceDelete();
            }

            $user->delete();
        }


        return redirect()->route('users.index')->with('msg', 'User Account Suspended');
    }
}
