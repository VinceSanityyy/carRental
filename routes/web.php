<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cars', [App\Http\Controllers\HomeController::class, 'cars'])->name('cars');
Route::get('/getCars', [CarsController::class, 'getCars']);
Route::get('/getCarsForOwner', [CarsController::class, 'getCarsForOwner']);
Route::post('/confirmReservation',[ReservationController::class,'confirmReservation']);
Route::post('/addCar',[CarsController::class,'addCar']);
Route::get('/getReservations',[ReservationController::class,'getReservations']);
Route::get('/getReservationDetails',[ReservationController::class,'getReservationDetails']);
Route::get('/getReservationRequest',[ReservationController::class,'getReservationRequest']);

Route::post('/approveReservation',[ReservationController::class,'approveReservation']);


Route::get('paymentsuccess',[PaymentsController::class, 'payment_success']);
Route::get('paymenterror',[PaymentsController::class, 'payment_error']);
Route::get('getPaymentList',[PaymentsController::class, 'getPaymentList']);
Route::post('/charge',[PaymentsController::class, 'charge']);

Route::post('/approveUser',[UsersController::class,'approveUser']);
Route::get('/getUsers',[UsersController::class, 'getUsers']);

Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z]+)?' );
