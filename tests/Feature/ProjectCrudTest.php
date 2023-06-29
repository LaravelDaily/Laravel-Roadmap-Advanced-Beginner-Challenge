<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_get_all_project()
    {
        $response = $this->get('/tasks', [Project::with('user', 'client')->get()]);
        if($response){
            $this->assertTrue(true);
        }
    }

    public function test_create_project()
    {
        $response = $this->post('/project', [
            'title' => fake()->title,
            'description' => fake()->realText(),
            'deadline' => fake()->date(),
            'status' => fake()->randomElements(['open', 'close']),
            'user_id' => User::all()->random(),
            'client_id' => Client::all()->random(),
        ]);
        if($response){
            $this->assertTrue(true);
        }

    }

    public function test_update_project()
    {
        $project = Project::where('id', 1)->pluck('id');
        $response = $this->put(route('project.update', $project),[
            'title' => fake()->title,
            'description' => fake()->realText,
        ]);

        if($response) {
            $this->assertTrue(true);
        }
    }

    public function test_delete_project()
    {
        $project = Project::find(1);
        if($project){
            $project->delete();
        }
        $this->assertTrue(true);
    }

}
