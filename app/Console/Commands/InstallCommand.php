<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Base installation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate');
        $this->call('storage:link');
        $this->call('queue:listen');

        return self::SUCCESS;
    }
}
