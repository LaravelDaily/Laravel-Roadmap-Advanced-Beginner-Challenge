<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateClientRequset;
use App\Http\Requests\Client\UpdateClientRequset;
use App\Models\Clients;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Clients::paginate(10);
        return view('pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequset $request)
    {   
        Clients::create($request->validated());
        toast()->success('Successed','Client created successfully');
        return redirect()->route('clients.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        return view('pages.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequset $request, Clients $client)
    {
        $client->update($request->validated());
        toast()->success('Successed','Client updated successfully');
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $client)
    {
        $client->delete();
        toast()->success('Successed','Client deleted successfully');
        return back();
    }

}
