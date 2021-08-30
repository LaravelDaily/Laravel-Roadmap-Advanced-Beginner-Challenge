<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientCollection;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('permission:create clients')->only('store');
        $this->middleware('permission:read clients')->only(['index', 'show']);
        $this->middleware('permission:update clients')->only('update');
        $this->middleware('permission:delete clients')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return new ClientCollection(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientRequest $clientRequest
     */
    public function store(ClientRequest $clientRequest)
    {
        $client = new Client();
        $validated = $clientRequest->validated();

        $response = $this->saveAndUpdate($client, $validated);

        return response()->json(['message' => 'Client created successfully', 'client' => $response], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return new ClientResource(Client::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientRequest  $clientRequest
     * @param  int  $id
     */
    public function update(ClientRequest $clientRequest, $id)
    {
        $client = Client::findOrFail($id);
        $validated = $clientRequest->validated();

        $response = $this->saveAndUpdate($client, $validated);

        return response()->json(['message' => 'Client updated successfully', 'client' => $response], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully'], 200);
    }

    /**
     * Save and update client info
     *
     * @param Client $client
     * @param $validated
     * @return ClientResource
     */
    public function saveAndUpdate(Client $client, $validated)
    {
        $client->name = $validated['name'];
        $client->vat = $validated['vat'];
        $client->address = $validated['address'];

        if (isset($validated['state']) && $validated['state'] == 'true'){
            $client->active = 1;
        }else{
            $client->active = 0;
        }

        $client->save();

        return new ClientResource($client);
    }
}
