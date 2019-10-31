<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\CartDetail;

class CartDetailController extends Controller {

    /**
     * Metodo que inserta los datos de un modelo de la BBDD
     * @return 
     */
    public function store(Request $request) {

        $cartDetail = new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();
        $notification = 'Se ha guardado correctamente el producto a tu carrito de compras';

        return back()->with(compact('notification'));
    }

    /**
     * Metodo que elimina un dato del modelo de la BBDD
     * @return 
     */
    public function destroy(Request $request) {

        $cartDetail = CartDetail::find($request->cart_detail_id);
        // echo '<pre>'; print_r(auth()->user()->cart->id); echo '</pre>';
        // echo '<pre>'; print_r( $cartDetail->cart_id); echo '</pre>';

        if ($cartDetail->cart_id == auth()->user()->cart->id) {
            $cartDetail->delete();
        }
        $notification = 'Se ha eliminado correctamente el producto de tu carrito de compras';
        return back()->with(compact('notification'));
    }

}
