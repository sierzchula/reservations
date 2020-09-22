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
        return view('Statistics/index');
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
