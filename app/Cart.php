<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cart extends Model
{
    //

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(product::class);
    }

    public static function createCart($id)
    {
        # code...
        try {
            //code...
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'quantity' => 1

            ]);
        } catch (Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
    }

    public static function getCart()
    {
        # code...]
        try {
            $cartItems = Auth::user()->Cart()->get();
        } catch (Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return $cartItems;
    }

    public static function price()
    {
        # code...
        try {
            //code...
            $carts = Auth::user()->Cart()->get();
            $price = 0;
            $products = [];
            foreach ($carts as $cart) {
                //cart -> prod_id
                // prodPrice( prod_id )
                $prod_price = Product::find($cart->product_id)->price;
                $qty =  $cart->quantity;
                $price += $prod_price * $qty;
                $products[] = product::find($cart->product_id);
            }

            // $price = 0;
            // foreach ($products as $product) $price += $product->price *($carts->where('product_id',$product->id)->get()->quantity);
            if ($price == 0) $total = 0; // if cart is empty delivery charges should be 0
            else $total = $price - ($price * 0.1) + 50;
        } catch (Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        // dd($price);
        return [$products, $price, $total];
    }

    public static function getQty($prod_id)
    {
        $prod = Auth::user()->Cart()->where('product_id', $prod_id)->get();
        return $prod[0]->quantity;
    }

    public static function updateCart(Request $request, $id)
    {
        //find product -> if product quantity > requested quantity 
        //->get user's cart 
        //->find the product and upate its quantity
        try {
            //code...
            $prod = product::find($id);
            if ($request->qty < 1) return 1;
            if ($request->qty <= $prod->qty) {
                $cart = Auth::user()->Cart();
                $cart->where('product_id', $id)->update(['quantity' => $request->qty]);
                return $request->qty;
            }
        } catch (Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return "Only " . $prod->qty . " in stock";
    }

    public static function deleteCart($id)
    {
        # code...
        try {
            //code...
            Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();
        } catch (Exception $e) {
            //throw $th;
            return view('layouts.errors', ["errors" => $e->getMessage()]);
            
        }
    }
}
