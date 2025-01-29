<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('company')->paginate();
        $companies = Company::all();

        return view('clients.index', compact(['clients', 'companies']));
    }

    public function create()
    {
        $companies = Company::all();
        return view('clients.create', compact('companies'))->with('statuses', Client::STATUS);
    }

    public function edit(Client $client)
    {
        $companies = Company::all();
        return view('clients.edit', compact(['companies', 'client']))->with('status', 'Client and company updated!');
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('status', 'Client and company created!');
    }

    public function destroy(Client $client, User $user)
    {
        Gate::authorize('manage_products');
        $client->delete();
        $client->company()->delete();
        return redirect(route('clients.index'))->with('status', 'Client and company deleted!');
    }
}
