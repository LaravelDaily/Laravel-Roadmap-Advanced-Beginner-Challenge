<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ClientNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return new ClientCollection($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request, ClientService $clientService)
    {
        return $clientService->create($request->validated());
    }

    /**
     * Display the specified resource.
     * @throws ClientNotFoundException
     */
    public function show(int $id, ClientService $clientService)
    {
        return $clientService->show($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws ClientNotFoundException
     */
    public function update(UpdateClientRequest $request, int $id, ClientService $clientService)
    {
        return $clientService->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     * @throws ClientNotFoundException
     */
    public function destroy(int $id, ClientService $clientService)
    {
        return $clientService->delete($id);
    }
}
