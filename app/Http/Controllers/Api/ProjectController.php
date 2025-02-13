<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\NewTaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function test()
    {
        return ProjectResource::collection(Project::paginate(20));
    }
    public function index(Request $request)
    {
       return ProjectResource::collection(Project::all());
    }

    public function show(Project $project)
    {
       return new ProjectResource($project);
    }
}
