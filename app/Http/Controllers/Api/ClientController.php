<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\ClientStoreRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return ClientResource::collection(Client::with('projects')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ClientStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ClientStoreRequest $request)
    {
        $client=Client::create($request->validated());
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClientStoreRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ClientStoreRequest $request, Client $client)
    {
        $client=Client::update($request->validated());
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
