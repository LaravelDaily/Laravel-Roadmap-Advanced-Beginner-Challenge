<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddResponseToTaskRequest;
use App\Http\Requests\CreateUpdateTaskRequest;
use App\Http\Resources\V1\ResponseResource;
use App\Http\Resources\V1\TaskResource;
use App\Models\Response;
use App\Models\Task;
use App\Services\SpatieMediaLibrary\AddMediaToModel;
use App\Services\TaskService;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TaskResource::collection(
            Task::filterByStatus()
                ->filterAssignedToUser()
                ->orderByDesc('id')
                ->paginate(Task::PAGINATE)
                ->withQueryString()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateTaskRequest  $request
     * @param  AddMediaToModel  $addMediaToModel
     * @return TaskResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUpdateTaskRequest $request, AddMediaToModel $addMediaToModel)
    {
        $this->authorize('create', Task::class);

        $task = Task::create($request->except('media'));

        $addMediaToModel($request->input('media', []), $task);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateTaskRequest  $request
     * @param  Task  $task
     * @param  AddMediaToModel  $addMediaToModel
     * @return TaskResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateUpdateTaskRequest $request, Task $task, AddMediaToModel $addMediaToModel)
    {
        $this->authorize('update', $task);

        $task->update($request->except('media'));

        $addMediaToModel($request->input('media', []), $task);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }

    /**
     * Display a listing of the deleted resources.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function deleted()
    {
        return TaskResource::collection(Task::onlyTrashed()->paginate(Task::PAGINATE));
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
        $task = Task::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $task);

        $task->restore();

        return response()->json(['message' => 'Task restored']);
    }

    /**
     * @param  AddResponseToTaskRequest  $request
     * @param  TaskService  $service
     * @return ResponseResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function addResponse(AddResponseToTaskRequest $request, TaskService $service)
    {
        $task = Task::findOrFail(decrypt($request->input('task_id')));

        $this->authorize('addResponse', $task);

        $response = $service->addResponse($request->validated());

        return new ResponseResource($response);
    }
}
