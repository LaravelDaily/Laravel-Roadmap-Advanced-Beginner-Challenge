<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateClientRequest;
use App\Http\Resources\V1\ClientResource;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ClientResource::collection(Client::paginate(Client::PAGINATE));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateClientRequest  $request
     * @return ClientResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUpdateClientRequest $request)
    {
        $this->authorize('create', Client::class);

        $client = Client::create($request->validated());

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return ClientResource
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateClientRequest  $request
     * @param  Client  $client
     * @return ClientResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateUpdateClientRequest $request, Client $client)
    {
        $this->authorize('update', $client);

        $client->update($request->validated());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return response()->json(['message' => 'Client deleted']);
    }

    /**
     * Display a listing of the deleted resources.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function deleted()
    {
        return ClientResource::collection(Client::onlyTrashed()->paginate(Client::PAGINATE));
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $client = Client::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $client);

        $client->restore();

        return response()->json(['message' => 'Client restored']);
    }
}
