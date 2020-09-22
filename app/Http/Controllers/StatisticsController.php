<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Reservations;
use App\Apartments;
use App\Clients;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {

        if ( !$request->start_date || !$request->end_date )
        {
            $start_date = strtotime("first day of this month");
            $end_date = strtotime("last day of this month");
        }
        else
        {
            $start_date = strtotime($request->start_date);
            $end_date = strtotime($request->end_date);
        }

        $carbon_start_date = Carbon::createFromTimestamp( $start_date );
        $carbon_end_date = Carbon::createFromTimestamp( $end_date );

        //get all the reservations that ends in selected date range, and starts in selected date range
        $reservations = Reservations::where('end_date', '>=', $start_date )
            ->where('start_date', '<=', $end_date)
            ->get()->toArray();

        //create apartments list with an ID as a KEY
        $apartmentsDB = Apartments::All()->toArray();
        foreach ($apartmentsDB as $apartmentDB)
        {
            $apartments[ $apartmentDB['id'] ] = $apartmentDB;
        }

        //default values
        $stats = [
            'count_available_days' => $carbon_end_date->diffInDays( $carbon_start_date ), //total days in the timeframe
            'count_apartments' => count( $apartments ), //total numeber of apartments
            'total_possible_days_of_rent' => $carbon_end_date->diffInDays( $carbon_start_date ) * count( $apartments ), //total days in the timeframe * total numeber of apartments
            'overlapping' => 0, //just overlapping
            'internal' => 0, //reservations that start and end at selected timeframe
            'estimated_total_income' => 0, //days in the timeframe * price per day
            'estimated_prepaid_value' => 0, //calculate if prepaid covers days that are in the timeframe based on price per day
            'payments_left' => 0, //how much left has to be paid, for the days that are in the timeframe
            'percent_of_rent' => 0, //global value of total reserved days / possible days * number of apartments in %
            'count_reserved_days' => 0, //total reserved days excluding overlap outside the timeframe
            'average_length_of_reservation' => 0, //all reservations lengths / amount
            'apartments' => [], //[apartments_id][total_income_per_apartment] = real money that has been paid for the apartments including prepaid in the selected timeframe
            'total_reserved_apartments' => 0 //number of reserved apartments
        ];

        foreach ( $reservations as $reservation )
        {

            $res_start_date = Carbon::createFromTimestamp( $reservation['start_date'] );
            $res_end_date = Carbon::createFromTimestamp( $reservation['end_date'] );

            //check for overlap
            if ( $reservation['start_date'] < $start_date ) //starts before
            {
                $stats['overlapping']++;
                $res_real_days_duration = $carbon_start_date->diffInDays( $res_end_date );
            }
            else if ( $reservation['end_date'] > $end_date ) //ends after
            {
                $stats['overlapping']++;
                $res_real_days_duration = $carbon_end_date->diffInDays( $res_start_date );
            }
            else
            {
                $stats['internal']++;
                $res_real_days_duration = $res_start_date->diffInDays( $res_end_date );
            }

            if ( isset( $stats['apartments'][ $reservation['apartments_id'] ] ) )
            {
                $stats['apartments'][ $reservation['apartments_id'] ] = $apartments[ $reservation['apartments_id'] ]; //save apartment data if has an reservation
                //$stats['apartments'][ $reservation['apartments_id'] ][' total_reservations_value_adjusted '] = 0;
            }
            $stats['count_reserved_days'] += $res_real_days_duration; //total days of reservations placed
            $stats['estimated_total_income'] += $res_real_days_duration * $reservation['price_day'];
            //$stats['apartments'][ $reservation['apartments_id'] ][' total_reservations_value_adjusted '] += $stats['estimated_total_income'];

        }

        $stats['total_reserved_apartments'] = count( $stats['apartments'] ); //reserved apartments count
        $stats['average_length_of_reservation'] = round( $stats['count_reserved_days'] / ( $stats['overlapping'] + $stats['internal'] ) ); 
        $stats['percent_of_rent'] = $stats['count_reserved_days'] / $stats['total_possible_days_of_rent'] * 100;

        return view('Statistics/index', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'stats' => $stats,
            'reservations' => $reservations,
            'apartments' => $apartments
        ]);
    }

/*
    TODO:
    - wartosc zaliczek
    - calkowite wplacone pieniadze
    - sredni przychod na apartament
*/
}
