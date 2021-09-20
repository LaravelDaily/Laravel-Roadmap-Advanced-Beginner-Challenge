<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateUserRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(User::PAGINATE);

        $title = 'User list';

        return view('user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $title = 'User create';

        return view('user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateUserRequest  $request
     * @param  UserService  $service
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUpdateUserRequest $request, UserService $service)
    {
        $this->authorize('create', User::class);

        $service->store($request->validated());

        return redirect(route('user.index'))->with('created', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $user->load('roles');

        $title = 'User edit: '.$user->name;

        return view('user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateUserRequest  $request
     * @param  User  $user
     * @param  UserService  $service
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateUpdateUserRequest $request, User $user, UserService $service)
    {
        $this->authorize('update', $user);

        $service->update($user, $request->validated());

        return redirect(route('user.edit', $user->id))->with('updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect(route('user.index'))->with('deleted', true);
    }

    /**
     * Display a listing of the deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $users = User::onlyTrashed()->paginate(User::PAGINATE);

        $title = 'Deleted users list';

        return view('user.index', compact('title', 'users'));
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $user);

        $user->restore();

        return redirect(route('user.deleted'))->with('restored', true);
    }
}
