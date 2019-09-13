<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    /**
     * Metodo que define la relacion entre Category->Products
     */
    public function products(){
    	
    	return $this->hasMany(Product::class);
    }

    public function getImageAttribute(){
        
    	if( !isset($this->attributes['image']) ){
    		return '/images/categories/default/default.png';
        }

    	return '/images/categories/' .$this->attributes['image'];

    }
}
