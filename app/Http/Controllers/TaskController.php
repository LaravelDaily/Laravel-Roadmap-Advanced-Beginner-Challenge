<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use DateTime;
use App\Mail\TaskCreated;
use Illuminate\Support\Facades\Mail;
use App\Notifications\TaskUpdated;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tasks = Task::excludeState(4)->orderBy('deadline', 'asc')->paginate(10);

        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $resources = $this->getResources();

        return view('task.create', [
            'users' => $resources['users'],
            'projects' => $resources['projects'],
            'states' => $resources['states']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest $taskRequest
     */
    public function store(TaskRequest $taskRequest)
    {
        $task = new Task();
        $validated = $taskRequest->validated();

        $taskCreated = $this->saveInformation($task, $validated);

        Mail::to($taskCreated->user)->send(new TaskCreated($taskCreated));

        return redirect('tasks')->with('message', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     */
    public function show(Task $task)
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     */
    public function edit(Task $task)
    {
        $resources = $this->getResources();
        $date = strtr($task->deadline, '/', '-');
        $date2 = DateTime::createFromFormat('m-d-Y', $date);
        $deadline = $date2->format('Y-m-d');

        return view('task.edit', [
            'task' => $task,
            'deadline' => $deadline,
            'users' => $resources['users'],
            'projects' => $resources['projects'],
            'states' => $resources['states']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest $taskRequest
     * @param  \App\Models\Task  $task
     */
    public function update(TaskRequest $taskRequest, Task $task)
    {
        $validated = $taskRequest->validated();

        $taskUpdated = $this->saveInformation($task, $validated);

        $taskUpdated->user->notify(new TaskUpdated($taskUpdated));

        return redirect()->route('tasks.show', $task)->with('message', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('tasks')->with('message', 'Task deleted successfully');
    }

    /**
     * Return resources
     */
    protected function getResources()
    {
        $users = User::all();
        $projects = Project::all();
        $states = Status::all();

        return [
            'users' => $users,
            'projects' => $projects,
            'states' => $states
        ];
    }

    /**
     * Save information of a task
     *
     * @param Task $task
     * @param $values
     *
     * @return Task $task
     */
    protected function saveInformation(Task $task, $values)
    {
        $task->title = $values['title'];
        $task->description = $values['description'];
        $task->deadline = $values['deadline'];
        $task->user_id = $values['user_id'];
        $task->project_id = $values['project_id'];

        if ($values['state_id'] == null){
            $task->status_id = 1;
        }else{
            $task->status_id = $values['state_id'];
        }

        $task->save();

        return $task;
    }
}
