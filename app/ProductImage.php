<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * Metodo que defina la relacion de la tabla ProductImage -> Product
     */
    public function product(){

    	return $this->belongsTo(Product::class);
    }
    /**
     * Metodo de atributo calculado 'accesor'
     */
    public function getUrlAttribute(){

    	if(substr($this->image,0,4) === "http"){
    		return $this->image;
        }

    	return '/images/products/' .$this->image;

    }
}
