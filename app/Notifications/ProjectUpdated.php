<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectUpdated extends Notification
{
    use Queueable;

    /**
     * The project instance
     *
     * @var $project
     */
    public $project;

    /**
     * Create a new notification instance.
     *
     * @param Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
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
        $url = url('/projects/'.$this->project);

        return (new MailMessage)
                    ->subject('Project update')
                    ->greeting('Project update!')
                    ->line('One of your projects has been updated.')
                    ->action('View project', $url)
                    ->line('Have a nice day!');
    }
}
