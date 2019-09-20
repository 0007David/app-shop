<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Unit;
use App\ProductUnit;
use App\Category;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products')); // listado
    }

    public function create(){
        $categories = Category::all();
    	return view('admin.products.create')->with(compact('categories')); // formulario de registro
    }

    public function store(Request $request){

    	//objeto que nos muestra los campos enviados por un form
    	// dd($request->all());

    	$product = new Product();

    	$product->name = $request->input('name');
    	$product->price = $request->input('price');
        $product->base_quantity = $request->input('base_quantity');
        $product->stock = $request->input('stock');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');
        $product->category_id = $request->input('category_id');
    	//insert
    	$product->save();

    	return redirect('/admin/products');
    }

    public function edit($id){
    	// return "mostar el form para el product : $id";
    	$product = Product::find($id);
        $units = Unit::all();
        $unitsLeft = collect();
        $unitsRight = collect();
        foreach ($units as $key => $unit) {
            
            if( $key%2 == 0){
                $unitsLeft->push($unit);
            }else{
                $unitsRight->push($unit);
            }
        }
    	return view('admin.products.edit')->with(compact('product','unitsLeft','unitsRight')); // formulario de edicion
    }

    public function update(Request $request, $id){

    	$product = Product::find($id);

    	$product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->base_quantity = $request->input('base_quantity');
        $product->stock = $request->input('stock');
    	$product->description = $request->input('description');
    	$product->long_description = $request->input('long_description');


    	//update
    	$product->save();

    	return redirect('/admin/products');
    }

    public function assignQuatities(Request $request, $id){

        $units_id = $request->input('units');
        foreach ($units_id as $key => $unit) {
            ProductUnit::create(['product_id' => $id,'unit_id' => $unit]);   
        }
        
        return back();
    }

    public function destroy($id){

    	$product = Product::find($id);
    	//delete
    	$product->delete();

    	return back();
    }
}
