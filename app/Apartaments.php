<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartaments extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany('App\Reservations');
    }
}
