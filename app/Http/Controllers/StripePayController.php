<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Cart;

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
	        Session::flash ( $e.message(),' fail-message', "Error! Please Try again." );
	        return Redirect::back ();
	    }


    }

    public function payWithStripe2(Request $request){

    	$cart=Cart::find($request->cart_id);
    	// Insertando el Pago
			$pay = new Payment();
			$pay->amount = $request->amount;
			$pay->type = "Stripe";
			$pay->user_id = auth()->user()->id;
			$pay->event_id = $cart->event->id;
			$pay->save();

		$notification = 'Su pago por tajeta de debito ha sido exitoso!';
		$type='info';

		return redirect('/home')->with(compact('notification','type'));
    }
}
