<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Task;

class TaskUpdated extends Notification
{
    use Queueable;

    /**
     * The Task instance
     *
     * @var $task
     */
    public $task;

    /**
     * Create a new notification instance.
     *
     * @param Task $task
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/tasks/'.$this->task);

        return (new MailMessage)
            ->subject('Task update')
            ->greeting('Task update!')
            ->line('One of your tasks has been updated.')
            ->action('View task', $url)
            ->line('Have a nice day!');
    }
}
