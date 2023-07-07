<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\StoreRequest;
use App\Http\Requests\Crm\Client\UpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ClientResource::collection(
          Client::query()
              ->latest()
              ->paginate($request->input('limit', 10))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        return new ClientResource(
          Client::query()->create($data)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Client $client)
    {
        $client->update($request->validated());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
