<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reservations';

    public function reservationDetails()
    {
        return $this->hasMany('App\Models\ReservationDetails');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
