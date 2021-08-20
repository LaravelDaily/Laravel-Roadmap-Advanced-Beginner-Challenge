<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $clients = Client::withCount('projects')->with('projects')->orderBy('projects_count', 'desc')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasRole('admin'), 401, __('Not Allowed action'));
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\ClientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        if (!$client=Client::create($request->validated())) {
            return redirect()->back()->with(['error' => __('Create error')]);
        }
        return redirect()->to(url('/clients'))->with(['message' => $client->name . ' ' . __('Successfully created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {

        //dd(Auth::user()->hasRole('user'), (int)Auth::id() === (int)$client->created_by);
        abort_if(
                    (   !Auth::user()->hasRole('admin') &&
                        !(Auth::user()->hasRole('user') && (int)Auth::id() === (int)$client->created_by)
                    ), 401, __('Not Allowed action'));
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientStoreRequest $request, Client $client)
    {
        if (!$client->update($request->validated())) {
            return redirect()->back()->with(['error' => __('Update error')]);
        }
        return redirect()->to(url('/clients'))->with(['message' => $client->name . ' ' . __('Successfully updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        abort_if(
            (   !Auth::user()->hasRole('admin') &&
                !(Auth::user()->hasRole('user') && (int)Auth::id() === (int)$client->created_by)
            ), 401, __('Not Allowed action'));
        abort_if($client->projects->count() > 0, 403, __($client->name . ' ' . "Can't be deleted, becouse has projects"));

        if ($client->delete()) {
            return redirect(url('/clients'))->with(['message' => __('Successfully deleted')]);
        }
    }
}
