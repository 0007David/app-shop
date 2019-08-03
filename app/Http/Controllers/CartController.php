<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{

	/**
	 * Metodo que muestra el contenido inicial hacia una vista
	 * @return view
	 */
	public function index(){

		return view('welcome');
	}

	/**
	 * Muestra el formulario donde insertar un datos a un modelo de la BBDD
	 * @return 
	 */
	public function create(){

	}

	/**
	 * Metodo que inserta los datos de un modelo de la BBDD
	 * @return 
	 */
	public function store(){
	
	}

	/**
	 * Metodo que devuelve el formulario para editar los datos de un modelo de la BBDD
	 * @return 
	 */
	public function edit(){
	
	}

	/**
	 * Metodo que actualiza los datos de un modelo de la BBDD
	 * @return 
	 */
	public function update(){
		$cart = auth()->user()->cart;
		if($cart->details->count() > 0){
			$cart->status = 'Pending';
			$cart->save(); //update
			$notification = 'Tu pedido se ha registrado correctamente. te contactaremos pronto via mail.';
			$type='success';
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
