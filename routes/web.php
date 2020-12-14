<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\PaymentsController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getCars', [CarsController::class, 'getCars']);
Route::post('/confirmReservation',[ReservationController::class,'confirmReservation']);
Route::post('/addCar',[CarsController::class,'addCar']);
Route::get('/getReservations',[ReservationController::class,'getReservations']);
Route::get('/getReservationDetails',[ReservationController::class,'getReservationDetails']);

Route::get('paymentsuccess',[PaymentsController::class, 'payment_success']);
Route::get('paymenterror',[PaymentsController::class, 'payment_error']);
Route::get('getPaymentList',[PaymentsController::class, 'getPaymentList']);
Route::post('/charge',[PaymentsController::class, 'charge']);

Route::get('{path}',[App\Http\Controllers\HomeController::class, 'index'])->where( 'path', '([A-z]+)?' );
