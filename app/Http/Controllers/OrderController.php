<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Orders;
use App\product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code...
        $orders = Orders::all();

        return view('admin.orders', compact('orders'));
    }

    public function checkout()
    {
        $cartItems = Auth::user()->Cart()->get();
        foreach($cartItems as $cartItem)
       $cartItem->product = product::find($cartItem->product_id);
        # code...
        // $carts = Auth::user()->cart()->get();
        $price = Cart::price()[1];
        $total = Cart::price()[2];
        $shipping = Auth::user()->shipping;
        // $shippingp[] = $shippingC->;
        // dd($shipping);
        // dd($cart);
        return view('checkout', ['cartItems' => $cartItems, 'price' => $price, 'total' => $total,'shipping'=>$shipping]);
    }

    public function store()
    {
        //items where user_id = auth user__id
        $carts = Auth::user()->cart()->get();
        $order_id = Orders::latest()->first()->id + 1; // get the last order id 

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

    public function update($id, $status)
    {
        # code...

        $order = Orders::find($id);
        $order->status = $status;
        $order->save();


        return $order->status;
    }

    public function show() // shows user's placed orders
    {
        # code...
        try {
            $user = Auth::user();
            
            $orders = Orders::join('products', function ($join) {

                $join->on('orders.product_id', '=', 'products.id')->where('orders.user_id', Auth::user()->id);
            
            })->select('*', 'orders.quantity as order_quantity')->get();
            
        } catch (\Exception $e) {
            dd($e);
        }
        return view('orders', compact('orders'), compact('user'));
    }
}
