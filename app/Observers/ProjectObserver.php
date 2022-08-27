<?php

namespace App\Observers;


use App\Models\Projects;
use App\Models\User;
use App\Notifications\SystemNotifications;
use Illuminate\Support\Facades\Notification;
class ProjectObserver
{

    public $admin;

    public function __construct()
    {
        $this->admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }

    /**
     * Handle the Projects "created" event.
     *
     * @param  \App\Models\Projects  $projects
     * @return void
     */
    public function created(Projects $projects)
    {
        $project = [
            'name' => $projects->title,
            'type' => 'Created',
            'message' => 'New Project Has Been Created',
            'icon' => 'laptop',
            'color' => 'info',
        ];
        Notification::send($this->admin , new SystemNotifications($project));
    }

    /**
     * Handle the Projects "updated" event.
     *
     * @param  \App\Models\Projects  $projects
     * @return void
     */
    public function updated(Projects $projects)
    {
        $project = [
            'name' => $projects->title,
            'type' => 'Updated',
            'message' => 'Project Has Been Updated',
            'icon' => 'laptop',
            'color' => 'warning',
        ];
        Notification::send($this->admin , new SystemNotifications($project));
    }

    /**
     * Handle the Projects "deleted" event.
     *
     * @param  \App\Models\Projects  $projects
     * @return void
     */
    public function deleted(Projects $projects)
    {
        $project = [
            'name' => $projects->title,
            'type' => 'Deleted',
            'message' => 'Project Has Been Deleted',
            'icon' => 'laptop',
            'color' => 'danger',
        ];
        Notification::send($this->admin , new SystemNotifications($project));
    }

    /**
     * Handle the Projects "restored" event.
     *
     * @param  \App\Models\Projects  $projects
     * @return void
     */
    public function restored(Projects $projects)
    {
        //
    }

    /**
     * Handle the Projects "force deleted" event.
     *
     * @param  \App\Models\Projects  $projects
     * @return void
     */
    public function forceDeleted(Projects $projects)
    {
        //
    }
}
