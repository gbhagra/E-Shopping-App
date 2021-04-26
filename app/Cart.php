<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //

    protected $guarded= [];

    public function products()
        {
            return $this->hasMany(product::class);
        }

        public static function price()
        {
            # code...
            $carts = \Auth::user()->Cart()->get();

            $products = [];
            foreach ($carts as $cart) {
    
    
                $products[] = product::find($cart->product_id);
            }
    
            $price = 0;
            foreach ($products as $product) $price += $product->price * $product->qty;
           
            $total = $price -($price*0.1) + 50;
            return [$products,$price,$total];
        }
}
