<?php

namespace App\Http\Controllers;

use App\Apartaments;
use Illuminate\Http\Request;

class ApartamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Apartaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'persons' => ['required','min:1'],
            'notes' => 'nullable'
        ]);

        $apartament = new Apartaments($data);
        $apartament->save();

        return redirect()->route('apartaments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartaments  $apartaments
     * @return \Illuminate\Http\Response
     */
    public function show(Apartaments $id)
    {
        return view('Apartaments.show', compact($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartaments  $apartaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartaments $apartaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartaments  $apartaments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartaments $apartaments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartaments  $apartaments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartaments $apartaments)
    {
        //
    }
}
