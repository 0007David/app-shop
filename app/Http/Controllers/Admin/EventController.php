<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller {

    /**
     * Metodo que muestra el contenido inicial hacia una vista
     * @return view
     */
    public function index() {
        $events = Event::all()->where('state', 'Approved');
        return view('admin.events.index')->with(compact('events')); // listado
    }

    /**
     * Metodo que actualiza los datos de un modelo de la BBDD
     * @return 
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Metodo que muestra los datos de un modelo de la BBDD
     * @return 
     */
    public function show($id) {

        $event = Event::find($id);
        $details = $event->cart->details;

        return view('admin.events.show')->with(compact('event', 'details'));
    }

}
