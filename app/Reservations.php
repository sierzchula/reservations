<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $guarded = [];

    public function apartament()
    {
        return $this->hasOne('App\Apartaments');
    }

    public function client()
    {
        return $this->hasOne('App\Clients');
    }
}
