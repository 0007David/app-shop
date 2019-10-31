<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Product;

class OrderController extends Controller {

    /**
     * Metodo que muestra el contenido inicial hacia una vista
     * @return view
     */
    public function index() {

        $orders = Event::all()->where('state', 'Revision');

        return view('admin.orders.index')->with(compact('orders'));
    }

    public function edit($id) {

        $order = Event::find($id);
        $products = Product::all();
        $details = $order->cart->details;

        return view('admin.orders.edit')->with(compact('order', 'details', 'products'));
    }

    public function orderApprove(Request $request, $id) {

        $order = Event::find($id);
        $order->transport_cost = $request->transport_cost;

        $order->state = 'Approved';
        $order->cart->status = 'Approved';
        $order->cart->save();
        $order->save();
        //Disminuir el stock del producto
        $details = $order->cart->details;
        foreach ($details as $key => $detail) {
            $product_id = $detail->product_id;
            $product = Product::find($product_id);
            $product->busy_stock = $product->busy_stock + $detail->quantity;
            $product->save();
        }
        //Una vez Aprovado Debo enviar un correo Electronico al cliente



        return redirect('/admin/order');
    }

    public function orderDeny(Request $request, $id) {

        $order = Event::find($id);
        $order->state = 'Deny';
        $order->cart->status = 'Deny';

        $order->save();
        //Una vez Denegado Debo enviar un correo Electronico al cliente

        return redirect('/admin/order');
    }

}
