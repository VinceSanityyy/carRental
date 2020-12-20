<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetails extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reservation_details';

    public function car()
    {
        return $this->belongsTo('App\Models\Cars');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Models\Reservation');
    }
}
