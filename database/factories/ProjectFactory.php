<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->domainName(),
            'description' => $this->faker->realText,
            'deadline'    => Carbon::now()->addDays(rand(30, 90)),
            'client_id'   => Client::inRandomOrder()->first()->id,
            'user_id'     => User::inRandomOrder()->first()->id,
            'status_id'   => collect(Project::$statuses)->keys()->random(),
        ];
    }

    public function configure()
    {
        if (App::environment('local')) {
            return $this->afterCreating(function (Project $project) {
                $times = rand(0, 10);
                for ($i = 0; $i < $times; $i++) {
                    $filename = uniqid().'.jpg';
                    $project->addMedia(Arr::random(File::files(storage_path('fake-images')))->getPathname())
                            ->preservingOriginal()
                            ->usingFileName($filename)
                            ->toMediaCollection();
                }
            });
        }

        return $this;
    }
}
