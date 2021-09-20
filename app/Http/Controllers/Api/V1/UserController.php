<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return UserResource::collection(User::paginate(User::PAGINATE));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateUserRequest  $request
     * @param  UserService  $service
     * @return UserResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUpdateUserRequest $request, UserService $service)
    {
        $this->authorize('create', User::class);

        $user = $service->store($request->validated());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateUserRequest  $request
     * @param  User  $user
     * @param  UserService  $service
     * @return UserResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateUpdateUserRequest $request, User $user, UserService $service)
    {
        $this->authorize('update', $user);

        $user = $service->update($user, $request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }

    /**
     * Display a listing of the deleted resources.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function deleted()
    {
        return UserResource::collection(User::onlyTrashed()->paginate(User::PAGINATE));
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $user);

        $user->restore();

        return response()->json(['message' => 'User restored']);
    }
}
