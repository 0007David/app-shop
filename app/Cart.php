<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cart extends Model
{
	/**
	 * Metodo que estable la relacion de un Cart con su details
	 */
    public function details(){

    	return $this->hasMany(CartDetail::class);
    }

    /**
	 * Metodo que estable la relacion de un Cart con User
	 */
	public function user(){

    	return $this->belongsTo(User::class);
    }    

    //Accesor
    public function getAmountAttribute(){
    	$totalAmount=0;
    	if(auth()->user()->cart->status == 'Active'){
    		$details = auth()->user()->cart->details;
    		$amount=0;  
    		foreach ($details as $key => $detail) {
    			$quantity = $detail->quantity;
    			$price = $detail->product->price;
    			$amount = $price * $quantity;
    			$totalAmount+= $amount;
    		}
    	}
    	return $totalAmount;
	}    
    
}
