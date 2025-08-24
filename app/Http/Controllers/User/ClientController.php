<?php

namespace App\Http\Controllers\User;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('client_access');
        $clients = Client::active()->get();
        return view('user.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('client_edit');
        return view('user.clients.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('client_edit');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'vat' => 'required|numeric|max:99999',
            'adress' => 'required|string|max:255',
        ]);

        //dd($validated);
        Client::create($validated);
        return redirect()->route('user.clients.index')->with('success', 'client Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $this->authorize('client_show');
        return view('user.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Client $client )
    {
        $this->authorize('client_edit');
        return view('user.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('client_edit');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'vat' => 'required|numeric|max:99999',
            'adress' => 'required|string|max:255',
        ]);
        $client->update( $validated );
        return redirect()->route('user.clients.index')->with('success', 'Client updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->authorize('client_delete');
        $client->delete();
        return redirect()->route('user.clients.index')->with('success', 'Client Deleted');
    }
}
