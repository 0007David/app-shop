<?php

namespace App\Http\Controllers;

use FarhanWazir\GoogleMaps\GMaps;
use Illuminate\Http\Request;

class CartController extends Controller
{

	
	/**
	 * Metodo CONVIERTE EL CARRITO EN UN PEDIDO
	 * @return 
	 */
	public function convertCartrToOrder(){

		$cart = auth()->user()['cart'];
		if($cart['details']->count() > 0){
			// $cart->status = 'Pending';
			// $cart->save(); //update
			$notification = 'Tu pedido se ha registrado correctamente. te contactaremos pronto via mail.';
			// $type='success';
			

			return view('events.index')->with(compact('notification'));		
		}else{
			$type='info';
			$notification = 'Debes registrar al menos un producto para realizar un pedido';
		}

		return back()->with(compact('notification','type'));
	}

	/**
	 * Metodo que muestra los datos de un modelo de la BBDD
	 * @return 
	 */
	public function show(){
	
	}

	/**
	 * Metodo que elimina un dato del modelo de la BBDD
	 * @return 
	 */
	public function destroy(){
	
	}

	

}
