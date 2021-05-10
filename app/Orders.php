<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //

    protected $guarded = [];

    public static function getOrder($id)
    {
        # code...
        $order = Orders::find($id);
        return $order;
    }

    public static function checkout()
    {

        try {

            // $cartItems = Cart::getCart();

            $cartItems = Cart::join('products',function($join){
                $join->on('carts.product_id','=','products.id')->where('carts.user_id', Auth::user()->id);
            })->select('*')->get();
            
            // foreach ($cartItems as $cartItem)
            //     $cartItem->product = product::find($cartItem->product_id);


            $price = Cart::price()[1];
            $total = Cart::price()[2];
            $shipping = Auth::user()->shipping;
        } catch (\Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return view('checkout', ['cartItems' => $cartItems, 'price' => $price, 'total' => $total, 'shipping' => $shipping]);
    }

    public static function storeOrder()
    {
        # code...
        try {
            //code...
            $carts = Cart::getCart();
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
                $product = product::getProduct($cart->product_id);
                $product->qty -= $cart->quantity;
                $product->save();
                //clearing cart
                Auth::user()->cart()->delete();
            }
        } catch (\Exception $e) {

            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        //items where user_id = auth user__id

        // preparing order_id for next order
        return $order_id;
    }

    public static function showOrders()
    {
        # code...
        try {
            $user = Auth::user();

            $orders = Orders::join('products', function ($join) {

                $join->on('orders.product_id', '=', 'products.id')->where('orders.user_id', Auth::user()->id);
            })->select('*', 'orders.quantity as order_quantity','orders.id as order_id' )->get();
        } catch (\Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        // dd($orders);
        return $orders;
    }
}
