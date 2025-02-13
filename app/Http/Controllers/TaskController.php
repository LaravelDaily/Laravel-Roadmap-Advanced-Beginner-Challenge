<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\NewTaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('user', 'project','project.client')->paginate();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::EmailVerified()->get();
        $projects = Project::with('client')->get();
        return view('tasks.create', compact(['users', 'projects']))->with('statuses', Task::STATUS);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());
        Notification::send(Auth::getUser(), new NewTaskNotification($task));
        $tasks = Task::with('user','project.client')->paginate();
        return view('tasks.index', compact('tasks'))->with('status', 'Project created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {        
        Notification::send(Auth::getUser(), new NewTaskNotification($task));
        $users = User::EmailVerified()->get();
        $projects = Project::active()->get();

        return view('tasks.edit', compact(['users', 'projects','task']))->with('statuses', Task::STATUS);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update',$task);

        $task->update($request->all());

        $tasks = Task::with('user', 'project','project.client')->paginate();

        return redirect(route('tasks.index', compact('tasks')))->with('status', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete',$task);
        $task->delete();
        return redirect(route('tasks.index'))->with('status', 'Task deleted!');
    }
}
