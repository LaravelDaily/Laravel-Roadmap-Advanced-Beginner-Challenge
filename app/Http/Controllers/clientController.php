<?php

namespace App\Http\Controllers;

use App\Http\Requests\clientStoreRequest;
use App\Http\Requests\clientUpdateRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->authorizeResource(Client::class,'client');

    }


    public function index()
    {
        $this->authorize('viewAny',Client::class);

        $clients=Client::all();
        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('clients.clientCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(clientStoreRequest $request)
    {
       Client::firstOrCreate([
           'name'=>$request->validated('name'),
           'email'=>$request->validated('email'),
           'phoneNumber'=>$request->validated('phoneNumber'),
           'VAT'=>$request->validated('VAT'),
           'address'=>$request->validated('address'),
       ]);
       return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
//        $this->authorize('update',$client);

        return view('clients.editClientInformation',compact('client'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(clientUpdateRequest $request,Client $client)
    {
        $client->update([
            'name'=>$request->validated('name'),
            'email'=>$request->validated('email'),
            'phoneNumber'=>$request->validated('phoneNumber'),
            'VAT'=>$request->validated('VAT'),
            'address'=>$request->validated('address'),
        ]);
        return redirect('/clients');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Client $client)
    {
            $client->delete();
        return redirect()->back();
    }
}
