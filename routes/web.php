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
//Convertir el CARRITO EN UNA ORDEN
Route::get('/order', 'CartController@convertCartrToOrder');
//Crear el evento y cerrar el carrito
Route::post('/event/store', 'EventController@store');
//PAGOS ONLINE
Route::post('/paypal', 'PaymentController@payWithpaypal');
Route::get('status','PaymentController@getPaymentStatus');

Route::get('/mapa', function(){
    $config = array();
    
	// $config['center'] = '-17.841135, -63.110573';
	// $config['zoom'] = '15';
	// $config['onclick'] = 'createMarker_map({ map: map, position:event.latLng });';
	$config['center'] = '37.4419, -122.1419';
	$config['zoom'] = 'auto';
	$config['directions'] = true;
	$config['directionsStart'] = 'empire state building';
	$config['directionsEnd'] = 'statue of liberty';
	$config['directionsDivID'] = 'directionsDiv';

	// $marker = array();
	// $marker['position'] = '37.429, -122.1419';
	// GMaps::add_marker($marker);
    GMaps::initialize($config);
    $map = GMaps::create_map();

    echo $map['js'];
    echo $map['html'];
    
    echo '<div id="directionsDiv"></div>';
});

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
	//asignar cantidad /quantity
	Route::post('/products/{id}/quantity', 'ProductController@assignQuatities'); // asigna cantidad
	
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
	// falta
	Route::get('/categories/{id}/edit', 'CategoryController@edit'); //formulario edit
	Route::post('/categories/{id}/edit', 'CategoryController@update'); //update
	Route::post('/categories/{id}/delete', 'CategoryController@destroy'); //delete

	//Lista de Pedidos Para ser Gestionados
	Route::get('/order', 'OrderController@index'); //ver formulario HTML
	Route::get('/order/{id}/edit', 'OrderController@edit'); //ver formulario HTML
	Route::post('/order/{id}/approve', 'OrderController@orderApprove'); //aprobar el pedido
	Route::get('/order/{id}/deny', 'OrderController@orderDeny'); //denegar el pedido

	//Eventos
	Route::get('/events', 'EventController@index'); //listado

	Route::get('/events/{id}/show', 'EventController@show');
});

// PATCH PUT DELETE
