<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Project;

class ProjectCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The project instance
     *
     * @var Project
     */
    public $project;

    /**
     * Create a new message instance.
     *
     * @param Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com', 'Example sender')
                    ->view('emails.project.created');
    }
}
