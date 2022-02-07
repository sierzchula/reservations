<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //creates backup file of sqlite database
        //$pdo = DB::connection()->getPdo();
        
        //save backup
        if ( copy('../database/database.sqlite', '../database/backup/' . date('dmY', time()) . '.sqlite') ) {
            $message["backup"] = "Utworzono";
        }else{
            $message["backup"] = "Wystąpił błąd";
        }

        return view('Backup/index')->withErrors($message);
    }

}
