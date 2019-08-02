<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // listado
    }

    public function create(){
        
    	return view('admin.products.create'); // formulario de registro
    }

    public function store(Request $request){

    	//objeto que nos muestra los campos enviados por un form
    	// dd($request->all());

    	$product = new Product();

    	$product->name = $request->input('name');
    	$product->price = $request->input('price');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');

    	//insert
    	$product->save();

    	return redirect('/admin/products');
    }

    public function edit($id){
    	// return "mostar el form para el product : $id";
    	$product = Product::find($id);
    	return view('admin.products.edit')->with(compact('product')); // formulario de edicion
    }

    public function update(Request $request, $id){

    	$product = Product::find($id);

    	$product->name = $request->input('name');
    	$product->price = $request->input('price');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');

    	//update
    	$product->save();

    	return redirect('/admin/products');
    }

    public function destroy($id){

    	$product = Product::find($id);
    	//delete
    	$product->delete();

    	return back();
    }
}
