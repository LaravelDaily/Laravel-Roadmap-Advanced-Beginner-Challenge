<?php

namespace App\Services;

use App\Exceptions\TaskNotFoundException;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskService
{
    public function create(array $data): JsonResponse
    {
        try {
            $createdTask = Task::create($data);
            return response()->json([
                'status' => 'success',
                'message' => 'The Task has been successfully created.',
                'data' => new TaskResource($createdTask->loadMissing('project')),
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

    }

    /**
     * @throws TaskNotFoundException
     */
    public function show(int $id): TaskResource
    {
        try {
            $task = Task::findOrFail($id);
            return new TaskResource($task->loadMissing('project'));
        } catch (ModelNotFoundException $e) {
            throw new TaskNotFoundException($id);
        }
    }

    /**
     * @throws TaskNotFoundException
     */
    public function update(array $data, int $id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            $task->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'The Task has been successfully updated.',
                'data' => $task->loadMissing('project'),
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new TaskNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    /**
     * @throws TaskNotFoundException
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'The Task has been successfully deleted.',
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new TaskNotFoundException($id);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'The Process is unreachable.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
