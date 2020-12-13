<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Enums\CarStatus;
class CarsController extends Controller
{
    public function addCar(Request $request){
        // dd($request->all());
        $car = new Cars;
        $car->user_id = \Auth::user()->id;
        $car->model = $request->model;
        $car->brand = $request->brand;
        $name = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('public/images');
        $car->image = $path;
        $car->plate_no = $request->plate_no;
        $car->reservation_fee = $request->reservation_fee;
        $car->pricePerDay = $request->pricePerDay;
        $car->status = 0;
        $car->save();

        return response()->json('success');
    }

    public function getCars(){
        $cars = Cars::where('status',CarStatus::AVAILABLE)->get();
        return response()->json($cars);
    }
}
