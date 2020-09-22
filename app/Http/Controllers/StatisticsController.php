<?php

namespace App\Http\Controllers;

use App\Reservations;
use App\Apartments;
use App\Clients;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {

        if ( !$request->start_date || !$request->end_date ) {
            $start_date = strtotime("first day of this month");
            $end_date = strtotime("last day of this month");
        }else{
            $start_date = strtotime($request->start_date);
            $end_date = strtotime($request->end_date);
        }

        return view('Statistics/index', [
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

/*
    TODO:
    - defaultowo pokaz caly aktualny miesiac
    - zakres dat co do dnia
    - ilosc rezerwacji
    - wartosc zaliczek
    - wartosc calkowita rezerwacji
    - calkowite wplacone pieniadze
    - oblozenie w %
    - sredni przychod na apartament
    - srednia dlugosc rozerwacji
*/
}
