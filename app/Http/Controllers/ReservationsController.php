<?php

namespace App\Http\Controllers;

use App\Reservations;
use App\Apartments;
use App\Clients;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( !$month = $request->route('month') ) {
            return redirect()->route('reservations.indexdate', [
                'year' => date('Y', time() ),
                'month' => date('m', time() )
            ]);
        }

        $year = $request->route('year');
        $month = $request->route('month');

        $reservations_query = Reservations::select([
            'id',
            'apartments_id',
            'clients_id',
            'start_date',
            'end_date',
            'status',
            'adults',
            'kids'
        ])
            ->selectRaw('( end_date - start_date ) /60/60/24 AS "days"')
            ->whereRaw('end_date >= ' . strtotime("first day of $month/01/$year") . ' AND start_date <= ' . strtotime("last day of $month/01/$year") )
            ->get();

        $apartments_query = Apartments::all();
        foreach ($apartments_query as $apartment) {
            $apartments[ $apartment['id'] ] = $apartment;
            $reservations[ $apartment['name'] ] = array('apartment_id' => $apartment['id']);
        }

        if ( count($apartments_query) == 0 ) {
            return redirect()->route('apartments.create');
        }

        /*
        array:
            -apartment name
                -reservation id
                    -reservation
        */

        foreach ( $reservations_query as $reservation) {
            $reservations[
                $apartments[
                    $reservation['apartments_id']
                ]
                ['name']
            ]
            [ $reservation['id'] ] = $reservation;
        }
//dd($reservations);
        return view('Reservations/index')
            ->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartments $apartment)
    {
        $clients_query = Clients::all()->sortByDesc("id");
        $apartments_query = Apartments::all()->sortByDesc("id");

        return view('Reservations/create', [
            'apartment' => $apartment,
            'apartments' => $apartments_query,
            'clients' => $clients_query
        ]);
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
        $data['start_date'] = strtotime( $data['start_date'] );
        $data['end_date'] = strtotime( $data['end_date'] );

        if ( $data['start_date'] >= $data['end_date'] ) {
            return redirect()->back()->withErrors(['Nieprawidłowy zakres dat']);
        }

        $findCollisionsCount = Reservations::where('end_date', '<=', $data['end_date'] )
            ->where('start_date', '>=', $data['start_date'])
            ->where('apartments_id', $data['apartments_id'])
            ->orWhere('end_date', '>', $data['start_date'] )
            ->where('start_date', '<', $data['start_date'])
            ->where('apartments_id', $data['apartments_id'])
            ->orWhere('start_date', '<', $data['end_date'] )
            ->where('end_date', '>', $data['end_date'])
            ->where('apartments_id', $data['apartments_id'])
            ->count();

        if ( $findCollisionsCount != 0 ) {
            return redirect()->back()->withErrors(['Apartament jest już zajęty w tym terminie, sprawdź wolne dni']);
        }

        $data['money_total'] = ($data['end_date'] - $data['start_date'])/60/60/24 * $data['price_day'];
        
        $reservation = new Reservations($data);
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function show(Reservations $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservations $reservation)
    {
        $clients_query = Clients::all()->sortByDesc("id");
        $apartments_query = Apartments::all()->sortByDesc("id");

        return view('Reservations/edit', [
            'reservation' => $reservation,
            'apartments' => $apartments_query,
            'clients' => $clients_query
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservations $reservation)
    {
        $data = $request->validate( $this->validateScheme );
        $data['start_date'] = strtotime( $data['start_date'] );
        $data['end_date'] = strtotime( $data['end_date'] );

        // get apartment reservations and validate if possible to make a new one

        $data['money_total'] = ($data['end_date'] - $data['start_date'])/60/60/24 * $data['price_day'];
        
        $reservation->update( $data );

        return redirect()->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservations  $reservations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservations $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index');
    }

    private $validateScheme = [
        'apartments_id' => 'required',
        'clients_id' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'price_day' => 'required',
        'money_paid' => 'required',
        'status' => 'required',
        'adults' => 'required',
        'kids' => 'required',
        'notes' => 'nullable'
    ];
}
