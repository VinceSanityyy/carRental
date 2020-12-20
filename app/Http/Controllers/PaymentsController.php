<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use Omnipay\Omnipay;
use App\Models\Cars;
class PaymentsController extends Controller
{
    public $gateway;
    public $res_id;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AQ4F9i02Qq2F3s3j8ZTts9E56Ydj5z1UQ3mdKOB-CkArL6agMre37FzPP4a3CbXB3SyqvDj_FGeoARr_');
        $this->gateway->setSecret('EDCLsKJFmeMc9lgTdWo2nmItMnv0BVXejnzvqQyQv_8RIIO75K45EwKzVok0ffV-VnKBPQHjHgXW3SKA');
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function charge(Request $request)
    {
        // dd($request->all());
   
        $request->session()->put('reservation_id', $request->reservation_id);
        $request->session()->put('car_id', $request->car_id);

        $response = $this->gateway->purchase(array(
            'amount' => $request->amount,
            'currency' => 'PHP',
            'returnUrl' => url('paymentsuccess'),
            'cancelUrl' => url('paymenterror'),
           
        ))->send();
        
    
        if ($response->isRedirect()) {
    
            // $response->redirect();
            return response()->json($response->getRedirectUrl());
        } else {
            // not successful
            return $response->getMessage();
        }
    }

    public function payment_success(Request $request)
    {
        // dd();
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
         
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                // dd($arr_body);
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();
                
                if(!$isPaymentExist)
                {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->payer_name = $arr_body['payer']['payer_info']['first_name'] ." " .$arr_body['payer']['payer_info']['last_name'];
                    $payment->currency = 'PHP';
                    $payment->payment_status = $arr_body['state'];
                    // $payment->reservation_id = $res_id = empty($request->reservation_id) ? 0 : $request->reservation_id;
                    $payment->reservation_id = $request->session()->get('reservation_id');
                    $payment->save();

                    $updateCar = Cars::find($request->session()->get('car_id'));
                    $updateCar->car_status = 1;
                    $updateCar->save();

                    $reservation = Reservation::find($request->session()->get('reservation_id'));
                    $reservation->status = 1;
                    $reservation->save();

                    $carOwner = Cars::find($request->session()->get('car_id'))->with('userCars')->first();
                    dd($carOwner);

                    // $ch = curl_init();

                    // curl_setopt($ch, CURLOPT_URL, 'https://textko.com/api/v3/sms');
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    // curl_setopt($ch, CURLOPT_POST, 1);
                    // curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"to\": \"09171234567\",\"text\": \"Hello from API.\"}");

                    // $headers = array();
                    // $headers[] = 'Authorization: Bearer your-access-token-here';
                    // $headers[] = 'Accept: application/json';
                    // $headers[] = 'Content-Type: application/json';
                    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    // $result = curl_exec($ch);
                    // if (curl_errno($ch)) {
                    //     echo 'Error:' . curl_error($ch);
                    // }
                    // curl_close($ch);


                }
                
                return response()->json("Payment is Successfull. Your transaction id is: ". $arr_body['id']);
                // return \Redirect::to('http://localhost:3000/donation/thankyou');
            } else {
                // return $response->getMessage();
                return 'asdasdas';
            }
        } else {
            return response()->json('Transaction is declined');
        }
    }

    public function payment_error()
    {
        return response()->json('User is canceled the payment.');
    }

    public function getPaymentList(){
        $list = \DB::table('cars')
            ->join('reservation_details','reservation_details.car_id','=','cars.id')
            ->join('users','cars.user_id','users.id')
            ->join('reservations','reservations.id','reservation_details.reservation_Id')
            ->join('payments','payments.reservation_id','reservations.id')
            ->where('cars.user_id',\Auth::user()->id)
            ->get();
        return response()->json($list);
    }
}
