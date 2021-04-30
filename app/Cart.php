<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(product::class);
    }

    public static function price()
    {
        # code...
        $carts = \Auth::user()->Cart()->get();
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
        // dd($price);
        return [$products, $price, $total];
    }
}
