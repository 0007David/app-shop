<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller {

    /**
     * Metodo que muestra el contenido inicial hacia una vista
     * @return view
     */
    public function index() {

        $categories = Category::all();
        return view('admin.categories.index')->with(compact('categories')); // listado
    }

    /**
     * Muestra el formulario donde insertar un datos a un modelo de la BBDD
     * @return 
     */
    public function create() {
        return view('admin.categories.create'); // formulario de registro
    }

    /**
     * Metodo que inserta los datos de un modelo de la BBDD
     * @return 
     */
    public function store(Request $request) {

        //guardar la imagen de la categoria
        $file = $request->file('photo');
        $fileName = null;
        if ($file) {
            $path = public_path() . '/images/categories';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->image = $fileName;
        $category->save();

        return back();
    }

    /**
     * Metodo que devuelve el formulario para editar los datos de un modelo de la BBDD
     * @return 
     */
    public function edit($id) {

        $category = Category::find($id);
        // echo '<pre>'; print_r($category); echo '</pre>';

        return view('admin.categories.edit')->with(compact('category')); // formulario de edicion
    }

    /**
     * Metodo que actualiza los datos de un modelo de la BBDD
     * @return 
     */
    public function update(Request $request, $id) {
        echo '<pre>';
        print_r($request . "\n" . $id);
        echo '</pre>';
    }

    /**
     * Metodo que muestra los datos de un modelo de la BBDD
     * @return 
     */
    public function show() {
        
    }

    /**
     * Metodo que elimina un dato del modelo de la BBDD
     * @return 
     */
    public function destroy() {
        
    }

}
