<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripePayController extends Controller
{
    

    public function payWithStripe(Request $request){
	    \Stripe\Stripe::setApiKey ('sk_test_jyAxWeaL9IfS3Nl0VFboqjmy00vtaZelsM');
	    try {
	        \Stripe\Charge::create ( array (
	                "amount" => $request->amount,
	                "currency" => "usd",
	                "source" => $request->stripeToken, // obtained with Stripe.js
	                "description" => "Pago por un Servicio." 
	        ) );
	        Session::flash ( 'success-message', 'Payment done successfully !' );
	        return Redirect::back ();
	    } catch ( \Exception $e ) {
	        Session::flash ( 'fail-message', "Error! Please Try again." );
	        return Redirect::back ();
	    }


    }
}
