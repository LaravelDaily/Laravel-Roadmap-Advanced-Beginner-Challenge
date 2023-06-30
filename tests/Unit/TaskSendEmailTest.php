<?php

namespace Tests\Unit;

use App\Enums\User\UserRoleEnum;
use App\Mail\TaskAdminEmail;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TaskSendEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_email_task_success()
    {
        $user = UserFactory::new()->create();
        $user->role = UserRoleEnum::Admin;
        ClientFactory::new()->create();
        ProjectFactory::new()->create();
        $task = TaskFactory::new()->create();

        Mail::fake();

        Mail::to($user->email)->send(new TaskAdminEmail($task));

        Mail::assertQueued(TaskAdminEmail::class, fn ($mailable) => $mailable->hasTo($user->email));
    }
}
