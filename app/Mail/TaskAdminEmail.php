<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskAdminEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $task;

    /**
     * Create a new message instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->markdown('mail.welcome', [
            'title' => $this->task['title'],
        ]);
    }
}
