<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    
            
    /**
     * Metodo que muestra los datos de un producto de la BBDD
     * @return 
     */
    public function show($id){

        // return "vista de producto id: $id";

    	$product = Product::find($id);
    	$images = $product->images()->where('featured',false)->get();
        $imagesLeft = collect();
    	$imagesRight = collect();
    	foreach ($images as $key => $image) {
    		
    		if( $key%2 == 0){
    			$imagesLeft->push($image);
    		}else{
    			$imagesRight->push($image);
    		}
    	}
    	
        return view('products.show')->with(compact('product','imagesLeft','imagesRight'));
    
    }

    
    
}

