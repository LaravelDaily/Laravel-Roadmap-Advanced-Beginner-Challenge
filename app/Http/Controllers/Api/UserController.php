<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('permissions')->paginate(5);
        return new UserCollection($users);
    }

    /**
     * Display the specified resource.
     * @throws UserNotFoundException
     */
    public function show(int $id)
    {
        return $this->userService->show($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws UserNotFoundException
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        return $this->userService->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     * @throws UserNotFoundException
     */
    public function destroy(int $id)
    {
        return $this->userService->delete($id);
    }
}
