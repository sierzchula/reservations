<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany('App\Reservations');
    }
}
