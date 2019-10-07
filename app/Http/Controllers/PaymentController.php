<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All PayPal Deatails Class */
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
// use Paypal\Exception\PayPalConnectionException;
use Redirect;
use Session;
use Config;
use App\Cart;
use App\Payment as Pay; //mi clase

class PaymentController extends Controller
{
    
    public function __construct()
    {
		/** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        // require('vendor/autoload.php');
		
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

	}

	public function payWithpaypal(Request $request)
    {

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$cart = Cart::find($request->cart_id);

		$item_list = new ItemList();
		
			
			$item = new Item();
			$item->setName('Productos Alquiler')
				   ->setCurrency('USD')
				   ->setQuantity(1)
				   ->setPrice($request->amount); 

			$item_list->setItems(array($item));	
		// echo '<pre>'; print_r($item_list); echo '</pre>';

		$amount = new Amount();

		$amount->setCurrency('USD')->setTotal($request->amount);
		$transaction = new Transaction();
		$transaction->setAmount($amount)
		            ->setItemList($item_list)
		            ->setDescription('Pagando con paypal mi pedido online');

		$redirect_urls = new RedirectUrls();
		/** Specify return URL **/
		$redirect_urls->setReturnUrl(url('status')) 
		            ->setCancelUrl(url('status'));
		$payment = new Payment();
		$payment->setIntent('Sale')
		            ->setPayer($payer)
		            ->setRedirectUrls($redirect_urls)
		            ->setTransactions(array($transaction));
		// Asumimos que todo va bien
		// Insertando el Pago
			$pay = new Pay();
			$pay->amount = $request->amount;
			$pay->type = "Paypal";
			$pay->user_id = auth()->user()->id;
			$pay->event_id = $cart->event->id;
			$pay->save();
		try {

			$payment->create($this->_api_context);

		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
			echo '<pre>';print_r(json_decode($ex->getData()));
			echo "Exception: " . $ex->getMessage() . PHP_EOL;
            $err_data = json_decode($ex->getData(), true);
            exit;

			if (\Config::get('app.debug')) {

				\Session::put('error', 'Connection timeout');
		        return Redirect::route('paywithpaypal');
			} else {

				\Session::put('error', 'Some error occur, sorry for inconvenient');
		        return Redirect::route('paywithpaypal');
			}
		}

		foreach ($payment->getLinks() as $link) {
			if ($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
		        break;
			}
		}
		/** add payment ID to session **/
		Session::put('paypal_payment_id', $payment->getId());

		if (isset($redirect_url)) {
		/** redirect to paypal **/
		    return Redirect::away($redirect_url);
		}

		\Session::put('error', 'Unknown error occurred');
		return Redirect::route('paywithpaypal');
	}



    public function getPaymentStatus(){

    	/** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
 
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
 
            \Session::put('error', 'Payment failed');
            return redirect('/home');
 
        }
 
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
 
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
 
        if ($result->getState() == 'approved') {

        	
 
            \Session::put('success', 'Payment success');
            return redirect('/home');
 
        }
 
        \Session::put('error', 'Payment failed');
        return redirect('/home');

    }


}
