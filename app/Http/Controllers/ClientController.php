<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('company')->searchStatus('active')->paginate();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('clients.create', compact('companies'))->with('statuses', Client::STATUS);
    }

    public function edit(Client $client)
    {
        $companies = Company::all();
        return view('clients.edit', compact(['companies', 'client']))->with('statuses', Client::STATUS);
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        $client->company()->delete();
        return redirect(route('clients.index'))->with('status', 'Client and company deleted!');
    }
}
