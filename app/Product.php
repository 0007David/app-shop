<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    /**
     * Metodo que defina la relacion de la tabla Product -> Caegory
     */
    public function category(){

    	return $this->belongsTo(Category::class);
    }

    /**
     * Metodo que defina la relacion de la tabla Product -> productImage
     */
    public function images() {

    	return $this->hasMany(ProductImage::class);
    }

    //Accesor
    public function getFeaturedImageUrlAttribute(){

        $featuredImage = $this->images()->where('featured',true)->first();
        if(!$featuredImage){
            $featuredImage =$this->images()->first();
        }

        if($featuredImage) {
            return $featuredImage->url;
        }
        //imagen por defecto
        return '/images/products/default/product-default.jpg';
    }

    public function getDescriptionToShowAttribute(){

        $descripcion = $this->description;
        if( strlen($descripcion) < 60 )
            return $descripcion;

        return substr($descripcion, 0,50)."...";
    }
}
