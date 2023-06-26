<?php

namespace App\Http\Controllers\Crm\Task;

use App\Enums\Task\TaskStatusesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Task\StoreRequest;
use App\Http\Requests\Crm\Task\UpdateRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return view('crm.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = TaskStatusesEnum::cases();
        $clients = Client::query()->select(['id', 'title_company'])->get();
        $users = User::query()->select(['id', 'name'])->get();
        $projects = Project::query()->select(['id', 'title'])->get();

        return view('crm.task.create', compact('statuses', 'clients', 'users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Task::query()->create($data);

        return redirect()->route('crm.task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('crm.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatusesEnum::cases();
        $clients = Client::query()->select(['id', 'title_company'])->get();
        $users = User::query()->select(['id', 'name'])->get();
        $projects = Project::query()->select(['id', 'title'])->get();

        return view('crm.task.edit', compact('statuses', 'clients', 'users', 'projects', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);

        return view('crm.task.show', compact('task'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('crm.task.index');
    }
}
