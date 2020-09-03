<?php

namespace App\Http\Controllers;

use App\Apartments;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get apartments list
        $apartments = Apartments::all()->sortByDesc("id");

        return view('Apartments/index')
        ->with('apartments', $apartments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Apartments.create');
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

        $apartment = new Apartments($data);
        $apartment->save();

        return redirect()->route('apartments.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartments  $apartments
     * @return \Illuminate\Http\Response
     */
    public function show(Apartments $apartment)
    {
        return view('Apartments.show')
            ->with('apartment', $apartment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartments  $apartments
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartments $apartment)
    {
        return view('Apartments.edit')
            ->with('apartment', $apartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartments  $apartments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartments $apartment)
    {

        $data = $request->validate( $this->validateScheme );

        $apartment->update( $data );

        return redirect()->route('apartments.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartments  $apartments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartments $apartment)
    {
        $apartment->delete();
        return redirect()->route('apartments.index');
    }

    private $validateScheme = [
        'name' => ['required', 'max:255'],
        'address' => ['required', 'max:255'],
        'persons' => ['required','digits_between:1,16', 'integer'],
        'notes' => 'nullable'
    ];
}
