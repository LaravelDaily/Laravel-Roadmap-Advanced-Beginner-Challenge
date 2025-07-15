<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Task;
use Symfony\Component\Console\Helper\ProgressBar;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('Creating 60 random projects.');
        $this->command->getOutput()->progressStart(60);
        for ($i = 0; $i < 60; $i++) {
            $project = Project::factory()->create();
            $url = 'https://picsum.photos/seed/'.uniqid().'/200/200';
            $file_name = storage_path('/tmp/').(rand(1,60)).'.jpg';
            file_put_contents( $file_name,file_get_contents($url));
            $project->addMedia($file_name)->toMediaCollection('projects');
            for ($j = 0; $j < rand(1, 4); $j++) {
                $task = Task::factory()->make()->toArray();
                $task['project_id'] = $project->id;
                $task['created_by'] = $project->created_by;
                $project->tasks()->create($task);
            }
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
