<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function checkout()
    {
        # code...
        $carts = Auth::user()->cart()->get();
        $shipping = Auth::user()->shipping;
        // $shippingp[] = $shippingC->;
        // dd($shipping);
        // dd($cart);
        return view('checkout',['carts'=>$carts,'shipping'=>$shipping]);
    }
}
