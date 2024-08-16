<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Feature\PHPUnit\UserTest;

abstract class TestCase extends BaseTestCase
{
    public function asAdmin(): TestCase
    {
        $admin = User::factory()->admin()->create();
        return $this->actingAs($admin);
    }

    public function asManager(): TestCase
    {
        $manager = User::factory()->manager()->create();
        return $this->actingAs($manager);
    }

    public function asSimpleUser(): TestCase
    {
        $simpleUser = User::factory()->simpleUser()->create();

        return $this->actingAs($simpleUser);
    }
}
