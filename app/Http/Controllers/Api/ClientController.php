<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return ClientResource::collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|min:3|max:255|string',
            'vat' => 'required|min:6|max:7',
            'address' => 'required|string',
        ]);

        $client = Client::create($request->all());

        return response([
            'message' => "Client Created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $client = Client::findorFail($id);
        } catch (\Exception $e) {
            abort(404, 'Client Not Found');
        }

        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company' => 'string|max:255|min:6',
            'vat' => 'min:6|max:7',
            'address' => 'string|max:255',
        ]);
        $client = Client::findorFail($id);

        $client->update($request->all());

        return response([
            'message' => 'Client Credientials Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $client = Client::findorFail($id);
        } catch (\Exception $e) {
            abort(404, 'Client Not Found');
        }
        $client->delete();

        return response([
            'message' => 'Client Deleted'
        ]);
    }
}
