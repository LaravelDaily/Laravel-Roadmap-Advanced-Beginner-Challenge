<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TaskNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('project')->paginate(7);
        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $this->taskService->create($request->validated());
    }

    /**
     * Display the specified resource.
     * @throws TaskNotFoundException
     */
    public function show(int $id)
    {
        $this->taskService->show($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws TaskNotFoundException
     */
    public function update(UpdateTaskRequest $request, int $id)
    {
        $this->taskService->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     * @throws TaskNotFoundException
     */
    public function destroy(int $id)
    {
        $this->taskService->delete($id);
    }
}
