<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Orders;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        # code...
        $carts = Auth::user()->cart()->get();
        $shipping = Auth::user()->shipping;
        // $shippingp[] = $shippingC->;
        // dd($shipping);
        // dd($cart);
        return view('checkout', ['carts' => $carts, 'shipping' => $shipping]);
    }

    public function store()
    {
        //items where user_id = auth user__id
        $carts = Auth::user()->cart()->get();
        $order_id = Orders::latest()->first()->id + 1;// get the last order id 

        // puting in order against a constant order_id
        foreach ($carts as $cart) {
            Orders::create([
                'user_id' => Auth::user()->id,
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
            // updating the quantity of product
            $product = product::find($cart->product_id);
            $product->qty -= $cart->quantity;
            $product->save();
            //clearing cart
            Auth::user()->cart()->delete();
        }
        // preparing order_id for next order


        return view('summary', compact('order_id'));
    }
}
