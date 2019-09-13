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

    
    
}
