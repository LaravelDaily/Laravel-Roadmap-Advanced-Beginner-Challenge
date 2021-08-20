<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $clients=Client::select('id')->inRandomOrder()->take(20)->pluck('id','id')->toArray();
        $users=User::select('id')->whereHas("roles", function($q){ $q->whereIn("name", ["admin","user"]); })->get()->pluck('id','id')->toArray();

        return [
            'title'=>$this->faker->text(30),
            'description'=>$this->faker->words(rand(10,80),1),
            'due_date'=>Carbon::today()->addDays(rand(-3, 60))->format('Y-m-d'),
            'user_id'=>array_rand($users),
            'client_id'=>array_rand($clients),
            'status'=>(rand(0,10)%3==0?1:0),
            'created_by'=>rand(1,15)
        ];
    }
}
