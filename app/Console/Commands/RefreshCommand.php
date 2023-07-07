<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        $this->call('cache:clear');
        $this->call('migrate:fresh', [
            '--seed' => true
        ]);

        return self::SUCCESS;
    }
}
