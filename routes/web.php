<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Usando un controlador
Route::get('/','TestController@welcome');

/*Route::get('/', function () {
    return view('welcome');
});*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Mostrar las caracteristicas de un producto
Route::get('/products/{id}', 'ProductController@show');
//Cargando un producto a un carrito
Route::post('/cart', 'CartDetailController@store');
//Elimina un detalle del carrito
Route::post('/cart/delete', 'CartDetailController@destroy');
//Convertir el pedido en una order
Route::post('/order', 'CartController@update');

//Middleware sobre un Grupo de rutas
Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function() {
	/**
	 * Los dos controladores se encuentran en en namespace Admin
	 * que son metodos que solo puede hacer un administrador
	 */
	// CRUD-Product
	Route::get('/products', 'ProductController@index'); //listado
	Route::get('/products/create', 'ProductController@create'); //formulario create
	Route::post('/products', 'ProductController@store'); //registrar
	Route::get('/products/{id}/edit', 'ProductController@edit'); //formulario edit
	Route::post('/products/{id}/edit', 'ProductController@update'); //update
	Route::post('/products/{id}/delete', 'ProductController@destroy'); //delete
	// ProductImage
	Route::get('/products/{id}/images', 'ProductImageController@index'); //formulario carga una imagen
	Route::post('/products/{id}/images/store', 'ProductImageController@store'); //guardar
	Route::post('/products/{id}/images', 'ProductImageController@destroy'); //form delete
	//destar imagen de un producto
	Route::get('/products/{id}/images/select/{img}', 'ProductImageController@select'); //formulario carga una imagen

	//CRUD-CATEGORIES
	Route::get('/categories', 'CategoryController@index'); //listado
	Route::get('/categories/create', 'CategoryController@create'); //formulario create
	Route::post('/categories', 'CategoryController@store'); //registrar

	Route::get('/categories/{id}/edit', 'CategoryController@edit'); //formulario edit
	Route::post('/categories/{id}/edit', 'CategoryController@update'); //update

});

// PATCH PUT DELETE
