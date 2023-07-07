<?php

namespace App\Http\Controllers\Crm\User;

use App\Enums\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\User\StoreRequest;
use App\Http\Requests\Crm\User\UpdateRequest;
use App\Jobs\User\StoreUserJob;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->select('id', 'name', 'email', 'role')
            ->get();

        return view('crm.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = UserRoleEnum::cases();

        return view('crm.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        StoreUserJob::dispatch($data);

        return redirect()->route('crm.main.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('crm.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = UserRoleEnum::cases();

        return view('crm.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return view('crm.user.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('crm.user.index');
    }
}
