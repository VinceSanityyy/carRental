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
        $update->car_status = CarStatus::OCCUPIED;
        $update->save();
        
        return response()->json('success');
    }

    public function getReservations(){
        $reservations = Reservation::where('user_id',\Auth::user()->id)->get();
        return response()->json($reservations);
    }

    public function getReservationDetails(Request $request){
        // dd($request->all());
        $details = ReservationDetails::where('reservation_id',$request->id)->with('car')->first();
        $reservation = Reservation::where('id',$request->id)->first();
        // dd($reservation);
        return response()->json(array(
            'details' => $details,
            'reservation' => $reservation
        ));
    }

    public function getReservationRequest(){
        $list = \DB::table('cars')
            ->join('reservation_details','reservation_details.car_id','=','cars.id')
            ->join('reservations','reservation_details.id','=','reservations.id')
            ->join('users','users.id','cars.user_id')
            ->where('cars.user_id',\Auth::user()->id)
            // ->select('cars.')
            ->get();

        return response()->json($list);
    }
    
    public function approveReservation(Request $request){
        // dd($request->reservation_id);
        $update = Reservation::find($request->reservation_id);
        $update->status = ReservationStatus::COMPLETED;
        $update->save();

        return response()->json('success');
    }
}
