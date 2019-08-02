<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TestController extends Controller{

	public function welcome(){

		$products = Product::paginate(9);
		// dd($products);
		return view('welcome')->with(compact('products'));
	}
    
}
