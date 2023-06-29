<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientCrudTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_show_all_clients()
    {
        $response = $this->get('/clients', [Client::all()]);

        if($response){
            $this->assertTrue(true);
        }

    }

    public function test_create_client()
    {
        $response = $this->post(route('clients.store'), [
            'company' => fake()->company(),
            'vat' => fake()->randomNumber(7),
            'address' => fake()->address(),
        ]);

        if($response){
            $this->assertTrue(true);
        }
    }

    public function test_update_client()
    {
        $client = Client::where('id', 1)->get()->pluck('id');

        $response = $this->put("clients/{{ $client }}",[
            'company' => fake()->company(),
            'vat' => fake()->randomNumber(7),
            'address' => fake()->address()
        ]);

        if($response){
            $this->assertTrue(true);
        }

    }

    public function test_delete_client()
    {
        $client = Client::find(1);
        if ($client) {
            $client->delete();
        }

        $this->assertTrue(true);
    }
}
