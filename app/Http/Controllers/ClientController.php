<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Notifications\FirstClient;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('show all user content')) {
            $clients = Client::active()->latest('id')->paginate(9);
        }else {
            $clients = Client::active()->latest('id')->where('user_id', auth()->user()->id)->paginate(9);
        }

        return view('clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client_status = Client::CLIENT_STATUS;
        
        return view('clients.create')->with('client_status', $client_status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $validate_data = $request->validated(); 
        $validate_data['user_id'] = auth()->id();
                
        $client = Client::create($validate_data);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $client->addMediaFromRequest('image')->toMediaCollection('images');
        }
        
        if(auth()->user()->clients()->count() === 1) {
            auth()->user()->notify(new FirstClient());
        }
        
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {   
        return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Gate::authorize('delete');

        try{
            $client->delete();
            return redirect()->route('clients.index');
        }catch (QueryException $exception) {
            return view('clients.parentError');
        }
    }
}
