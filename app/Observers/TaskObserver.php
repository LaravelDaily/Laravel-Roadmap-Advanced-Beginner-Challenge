<?php

namespace App\Observers;

use App\Models\Tasks;
use App\Models\User;
use App\Notifications\SystemNotifications;
use Illuminate\Support\Facades\Notification;
class TaskObserver
{

    public $admin;


    public function __construct()
    {
        $this->admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    }
    
    /**
     * Handle the Tasks "created" event.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return void
     */
    public function created(Tasks $tasks)
    {
        $task = [
            'name' => $tasks->title,
            'type' => 'Added',
            'message' => 'New Task Has Been Added',
            'icon' => 'task',
            'color' => 'info',
        ];
        Notification::send($this->admin , new SystemNotifications($task));
    }

    /**
     * Handle the Tasks "updated" event.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return void
     */
    public function updated(Tasks $tasks)
    {
        $task = [
            'name' => $tasks->title,
            'type' => 'Updated',
            'message' => 'Task Has Been Updated',
            'icon' => 'task',
            'color' => 'warning',
        ];
        Notification::send($this->admin , new SystemNotifications($task));
    }

    /**
     * Handle the Tasks "deleted" event.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return void
     */
    public function deleted(Tasks $tasks)
    {
        $task = [
            'name' => $tasks->title,
            'type' => 'Deleted',
            'message' => 'Task Has Been Deleted',
            'icon' => 'task',
            'color' => 'danger',
        ];
        Notification::send($this->admin , new SystemNotifications($task));
    }

    /**
     * Handle the Tasks "restored" event.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return void
     */
    public function restored(Tasks $tasks)
    {
        //
    }

    /**
     * Handle the Tasks "force deleted" event.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return void
     */
    public function forceDeleted(Tasks $tasks)
    {
        //
    }
}
