<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
/**
 * Clase Evento que le pertence a un Usuario
 */

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvent(Request $req)
    {
        $answer = array();
        $user = User::find($req->id);
        if($user->carts->where('status','Approved')->count() > 0){
            $event = $user->carts->where('status','Approved')->first()->event;
            $answer['event'] = $event;
            $answer['respuesta'] = true;

        }else{
            $answer['event'] = '{nada}';            
            $answer['respuesta'] = false;

        }
        
        
        return response()->json($answer); 

    }


}
