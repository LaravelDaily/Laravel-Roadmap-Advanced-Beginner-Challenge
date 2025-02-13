<?php

namespace Tests;

use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    protected $seed = false;
    protected function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        $this->artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class]);

    }
}
