<?php

namespace Tests\Feature;

use Illuminate\Database\Console\Migrations\FreshCommand;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Database\Console\WipeCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProhibitableFeatureTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_prohibitable_feature_not_available(): void
    {
        $this->artisan('migrate:fresh')->assertSuccessful();
        $this->artisan('migrate:refresh')->assertSuccessful();
        $this->artisan('migrate:reset')->assertSuccessful();
    }

    public function test_prohibitable_feature_available(): void
    {
        FreshCommand::prohibit();
        RefreshCommand::prohibit();
        ResetCommand::prohibit();
        WipeCommand::prohibit();
        $this->artisan('migrate:fresh')->assertFailed();
        $this->artisan('migrate:refresh')->assertFailed();
        $this->artisan('migrate:reset')->assertFailed();
        $this->artisan('db:wipe')->assertFailed();
    }
}
