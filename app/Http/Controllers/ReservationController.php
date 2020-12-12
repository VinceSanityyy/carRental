<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationDetails;
use App\Enums\ReservationStatus;
class ReservationController extends Controller
{
    public function confirmReservation(Request $request){

        // dd($request->all());
        $reservation = new Reservation;
        
        $reservation->user_id = \Auth::user()->id;
        $reservation->status = ReservationStatus::PENDING;
        $reservation->save();
        

        $reservation_details = new ReservationDetails;
        $reservation_details->reservation_id = $reservation->id;
        $reservation_details->locationFrom = $request->fromLocation;
        $reservation_details->locationTo = $request->toLocation;
        $reservation_details->dateFrom = $request->fromDate;
        $reservation_details->dateTo = $request->toDate;
        $reservation_details->totalDays = $request->totalDays;
        $reservation_details->totalDistance = $request->totalDistance;
        $reservation_details->estimatedDuration = $request->time;
        $reservation_details->save();

        return response()->json('success');
    }
}
