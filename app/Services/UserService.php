<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UserService
{
    /**
     * @param int $id
     * @return UserResource
     * @throws UserNotFoundException
     */
    public function show(int $id): UserResource
    {
        try {
            $user = User::findOrFail($id);
            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($id);
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function update(array $data, int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['name' => $data['name']]);
            $user->syncRoles($data['role']);
            return response()->json([
                'status' => 'success',
                'message' => 'The user has been successfully updated.'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The user has been successfully deleted.'
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new UserNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
