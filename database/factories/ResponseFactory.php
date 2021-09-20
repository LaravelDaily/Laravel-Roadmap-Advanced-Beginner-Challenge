<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Response::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $task = Task::inRandomOrder()->first();
        return [
            'content' => $this->faker->realText,
            'task_id' => $task->id,
            'user_id' => Arr::random([$task->project->user_id, User::first()->id]),
        ];
    }

    public function configure()
    {
        if (App::environment('local')) {
            return $this->afterCreating(function (Response $response) {
                $times = rand(0, 3);
                for ($i = 0; $i < $times; $i++) {
                    $filename = uniqid().'.jpg';
                    $response->addMedia(Arr::random(File::files(storage_path('fake-images')))->getPathname())
                             ->preservingOriginal()
                             ->usingFileName($filename)
                             ->toMediaCollection();
                }
            });
        }

        return $this;
    }
}
