<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get clients list
        $clients = Clients::all()->sortByDesc("id");

        return view('Clients/index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate( $this->validateScheme );

        $client = new Clients($data);
        $client->save();

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $client)
    {
        return view('Clients.show')
            ->with([
                'client' => $client,
                'reservations' => $client->reservations    
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        return view('Clients.edit')
            ->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $client)
    {
        $data = $request->validate( $this->validateScheme );

        $client->update( $data );

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }

    private $validateScheme = [
        'name' => ['required', 'max:255'],
        'phone' => ['required', 'max:16'],
        'address' => ['nullable','max:255'],
        'email' => ['nullable','email:rfc,dns'],
        'notes' => 'nullable'
    ];
}
