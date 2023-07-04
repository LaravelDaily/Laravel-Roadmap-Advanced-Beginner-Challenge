<?php

namespace Tests\Unit;

use App\Enums\User\UserRoleEnum;
use App\Mail\TaskAdminEmail;
use App\Mail\User\PasswordMail;
use Database\Factories\ClientFactory;
use Database\Factories\ProjectFactory;
use Database\Factories\TaskFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PasswordSendEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_email_task_success()
    {
        $user = UserFactory::new()->create();
        $user->role = UserRoleEnum::Admin;
        Mail::fake();

        Mail::to($user->email)->send(new PasswordMail($user));

        Mail::assertQueued(PasswordMail::class, fn ($mailable) => $mailable->hasTo($user->email));
    }
}
