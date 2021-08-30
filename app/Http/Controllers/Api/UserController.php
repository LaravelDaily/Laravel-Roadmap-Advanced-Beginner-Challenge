<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:update users')->only('update');
        $this->middleware('permission:delete users')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserEditRequest $userEditRequest
     * @param  int  $id
     */
    public function update(UserEditRequest $userEditRequest, $id)
    {
        $user = User::findOrFail($id);
        $validated = $userEditRequest->validated();

        if (isset($validated['name']) && $validated['name'] != null){
            $user->name = $validated['name'];
        }

        if (isset($validated['email']) && $validated['email'] != null){
            $user->email = $validated['email'];
        }

        if (isset($validated['role']) && $validated['role'] != null){
            $user->assignRole($validated['role']);
        }

        $user->save();

        $response = new UserResource($user);

        return response()->json(['message' => 'User updated successfully', $response], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
