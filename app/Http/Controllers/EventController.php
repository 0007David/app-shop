<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
	public function store(Request $request){

		//Cambiamos el estado del Carrito 
		$cart = auth()->user()->cart; 
		$cart_id = $cart->id; 
		$cart->status = 'Pending';
		$cart->save(); //update

		//Creamos el Evento
		$event = new Event();
		$event->cart_id = $cart_id;
		$event->name = $request->name;
		$event->address = $request->address;

		//new Formato de DATETIME
		$date = new \DateTime($request->date);
		$event->date = $date;

		$event->total_amount = $request->total_amount;
		$event->latitude = $request->latitude;
		$event->length = $request->length;
		
		$event->save();
		
		$notification = 'Se ha guardado correctamente el evento este atento a la confirmacion de su Evento A su Correo Electronico!';
		$type='info';

		return redirect('/home')->with(compact('notification','type'));


	}
}
