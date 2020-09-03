<?php

namespace App\Http\Controllers;

use App\Reservations;
use App\Apartments;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            ->whereRaw('end_date > ' . strtotime("first day of this month") . ' AND start_date < ' . strtotime("last day of this month") )
            ->get();

        $apartments_query = Apartments::all();
        foreach ($apartments_query as $apartment) {
            $apartments[ $apartment['id'] ] = $apartment;
            $reservations[ $apartment['name'] ] = array('apartment_id' => $apartment['id']);
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
        //TODO add reservation dates not available for datepicker for current apartment
        return view('Reservations/create')
            ->with('apartment', $apartment);
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

        $apartments_query = Apartments::all();

        foreach ($apartments_query as $apartment) {
            $apartments[ $apartment['id'] ] = $apartment;
        }

        return view('Reservations/edit', [
            'reservation' => $reservation,
            'apartments' => $apartments
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
