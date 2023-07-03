<?php

namespace App\Http\Controllers\Crm\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Client\StoreRequest;
use App\Http\Requests\Crm\Client\UpdateRequest;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);

        return view('crm.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Client::query()->create($data);

        return redirect()->route('crm.client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('crm.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('crm.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Client $client)
    {
        $data = $request->validated();
        $client->update($data);

        return view('crm.client.show', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('crm.client.index');
    }
}
