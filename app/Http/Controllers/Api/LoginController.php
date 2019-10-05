<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // $user = DB::table('users')->where('email',$request->email)->first();
        $user = User::all()->where('email','juan@gmail.com')->first();
        $answer = Array();

        if( $user != null){

            if(Hash::check($request->password, $user->password)){
                
                $answer['type'] = true;
                $answer['message'] = 'Login correcto';
                $answer['data'] = $user;
                
                // $answer['id'] = $user['id'];
                // $answer['name'] = $user['name'];
                // $answer['email'] = $user['email'];

            }else{

                $answer['type'] = false;
                $answer['message'] = "Existe usuario pero la contraseña incorrecta";
            }

        }else{
            $answer["type"] = false;
            $answer["message"] = "No existe Usuario";

        }

        return response()->json($answer); 

    }

    public function test(){

        echo json_encode("Hola desde mi Servidor");
        
    }

}
