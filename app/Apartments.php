<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartments extends Model
{
    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany('App\Reservations');
    }
    public function path()
    {
        return "/apartments/{$this->id}";
    }
}
