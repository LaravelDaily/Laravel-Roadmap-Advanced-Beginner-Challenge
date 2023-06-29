<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('viewAny', Client::class);
        $clientTrashed = Client::onlyTrashed();
        $clients = Client::with('clientable')->paginate(5);
        return view('panel.client.index', compact('clients', 'clientTrashed','unreadNotifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('create', Client::class);
        $clientTrashed = Client::onlyTrashed();
        return view('panel.client.create', compact('unreadNotifications', 'clientTrashed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Client::class);
        $request->validate([
            'company' => 'required|min:3|max:255|string',
            'vat' => 'required|min:6|max:7',
            'address' => 'required|string',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('msg', 'Client Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('view', Client::class);
        $clientTrashed = Client::onlyTrashed();
        return view('panel.client.show', compact('client', 'clientTrashed', 'unreadNotifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $this->authorize('update', Client::class);
        $clientTrashed = Client::onlyTrashed();
        return view('panel.client.edit', compact('clientTrashed','client', 'unreadNotifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', Client::class);
        $request->validate([
            'company' => 'string|max:255|min:6',
            'vat' => 'min:6|max:7',
            'address' => 'string|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('msg', $client->company . ' Data Updated');
    }

    public function restore(Client $client)
    {
        if($client->trashed()){
            $client->restore();
            return redirect()->route('clients.index');
        }
    }

    public function trash()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $trashedClient = Client::onlyTrashed()->paginate(5);
        return view("panel.client.trash", compact('trashedClient', 'unreadNotifications'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', Client::class);
        if($client->trashed()){
            $client->forceDelete();
        }
        $client->delete();

        return redirect()->route('clients.trash');
    }
}
