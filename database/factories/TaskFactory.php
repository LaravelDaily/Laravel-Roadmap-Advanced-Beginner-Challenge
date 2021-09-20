<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->realText(20),
            'description' => $this->faker->realText,
            'project_id'  => Project::inRandomOrder()->first()->id,
            'status_id'   => collect(Task::$statuses)->keys()->random(),
        ];
    }

    public function configure()
    {
        if (App::environment('local')) {
            return $this->afterCreating(function (Task $task) {
                $times = rand(0, 5);
                for ($i = 0; $i < $times; $i++) {
                    $filename = uniqid().'.jpg';
                    $task->addMedia(Arr::random(File::files(storage_path('fake-images')))->getPathname())
                         ->preservingOriginal()
                         ->usingFileName($filename)
                         ->toMediaCollection();
                }
            });
        }

        return $this;
    }
}
