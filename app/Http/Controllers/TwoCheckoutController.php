<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\BusinessSetting;
use App\Seller;
use Session;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\WalletController;

class TwoCheckoutController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Session::has('payment_type')){
            if(Session::get('payment_type') == 'cart_payment' || Session::get('payment_type') == 'wallet_payment'){
                return view('frontend.twocheckout.payment');
            }
        }
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
     function twocheckoutPost(Request $request)
    {
        //dd($request->all());
        Twocheckout::verifySSL(false);
        Twocheckout::privateKey('04B50F01-0112-4347-825C-91D70A299865');
        Twocheckout::sellerId('901419165');

        try {
            $charge = Twocheckout\Twocheckout_Charge::auth(array(
                "sellerId" => "250441397405",
                "merchantOrderId" => "123",
                "token" => $request->token,
                "currency" => 'USD',
                "total" => '10.00',
                "billingAddr" => array(
                    "name" => 'Testing Tester',
                    "addrLine1" => '123 Test St',
                    "city" => 'Columbus',
                    "state" => 'OH',
                    "zipCode" => '43123',
                    "country" => 'USA',
                    "email" => 'example@2co.com',
                    "phoneNumber" => '555-555-5555'
                )
            ));

            //dd($charge['response']);
            if($charge['response']['responseCode'] == 'APPROVED'){
                $payment = json_encode($charge['response']);
                if($request->session()->has('payment_type')){
                    if($request->session()->get('payment_type') == 'cart_payment'){
                        $checkoutController = new CheckoutController;
                        return $checkoutController->checkout_done(Session::get('order_id'), $payment);
                    }
                    elseif ($request->session()->get('payment_type') == 'wallet_payment') {
                        $walletController = new WalletController;
                        return $walletController->wallet_payment_done(Session::get('payment_data'), $payment);
                    }
                }
            }
            else {
                flash('Payment failed')->error();
                return redirect()->route('home');
            }

            //$this->assertEquals('APPROVED', $charge['response']['responseCode']);
        } catch (Twocheckout\Api\Twocheckout_Error $e) {
            dd($e);

            flash('Payment failed')->error();
            return redirect()->route('home');
            //$this->assertEquals('Unauthorized', $e->getMessage());
        }
    }
}
