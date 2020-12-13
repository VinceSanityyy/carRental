<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ReservationDetails;
use App\Enums\ReservationStatus;
use App\Models\Cars;
use App\Enums\CarStatus;
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
        $reservation_details->locationFrom = $request->bodyForm['fromLocation'];
        $reservation_details->locationTo = $request->bodyForm['toLocation'];
        $reservation_details->dateFrom = $request->bodyForm['fromDate'];
        $reservation_details->dateTo = $request->bodyForm['toDate'];
        $reservation_details->totalDays = $request->bodyForm['totalDays'];
        $reservation_details->totalDistance = $request->bodyForm['totalDistance'];
        $reservation_details->estimatedDuration = $request->bodyForm['time'];
        $reservation_details->car_id = $request->car_id;
        $reservation_details->save();

        

        $update = Cars::find($request->car_id);
        $update->status = CarStatus::OCCUPIED;
        $update->save();
        
        return response()->json('success');
    }
}
