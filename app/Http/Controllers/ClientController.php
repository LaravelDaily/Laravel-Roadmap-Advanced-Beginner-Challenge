<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Scopes\ActiveScope;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $clients = Client::active()->get();

        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientRequest  $clientRequest
     */
    public function store(ClientRequest $clientRequest)
    {
        $validated = $clientRequest->validated();

        $client = new Client();
        $client->name = $validated['name'];
        $client->vat = $validated['vat'];
        $client->address = $validated['address'];
        $client->active = true;
        $client->save();

        return redirect('clients')->with('message', 'Client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  $status
     */
    public function show($status)
    {
        if ($status === 'active'){
            $clients = Client::active()->get();
        } elseif ($status === 'inactive'){
            $clients = Client::active(false)->get();
        }

        return view('client.index', ['clients' => $clients]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     */
    public function edit($id)
    {
        $client = $this->checkIfExists($id);

        if (!$client){
            return redirect('clients')->with('error', 'This client doesn\'t exist');
        }

        return view('client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientRequest $clientRequest
     * @param  $id
     */
    public function update(ClientRequest $clientRequest, $id)
    {
        $client = $this->checkIfExists($id);

        if (!$client){
            return redirect('clients')->with('error', 'This client doesn\'t exist');
        }

        $validated = $clientRequest->validated();

        $client->name = $validated['name'];
        $client->vat = $validated['vat'];
        $client->address = $validated['address'];
        if($validated['state'] === 'true'){
            $client->active = true;
        }elseif($validated['state'] === 'false'){
            $client->active = false;
        }
        $client->save();

        return redirect('clients')->with('message', 'Client edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     */
    public function destroy($id)
    {
        $client = $this->checkIfExists($id);

        if (!$client){
            return redirect('clients')->with('error', 'This client doesn\'t exist');
        }

        $client->delete();

        return redirect('clients')->with('message', 'Client deleted successfully');
    }

    /**
     * Check if a client exists
     *
     * @param $id
     *
     */
    public function checkIfExists($id)
    {
        $client = Client::find($id);

        if (!$client){
            return false;
        }else{
            return $client;
        }
    }
}
