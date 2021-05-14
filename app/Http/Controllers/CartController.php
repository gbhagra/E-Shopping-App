<?php

namespace App\Http\Controllers;

use App\Cart;
use App\product;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // USER->CART
        //CART->PRODID
        //CART->PRODUCT = PRODUCT WHERE ID = CART->PRODUCTID
        try {
            //code...
            $cartItems = Cart::getCart();
            foreach ($cartItems as $cartItem)
                $cartItem->product = product::getProduct($cartItem->product_id);

            $price = Cart::price()[1];
            $total = Cart::price()[2];
        } catch (\Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return view('cart', ['cartItems' => $cartItems, 'price' => $price, 'total' => $total]);
    }
    public function getTotal()
    {
        # code...
        try {

            $price = Cart::price()[1];
            $total = Cart::price()[2];
        } catch (\Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return ['total' => $total, 'price' => $price];
    }

    public function getCartQty($prod_id)
    {
        return Cart::getQty($prod_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        //validation required 
        //store in db
        try {

            $inCart = Product::inCart($id);
            if (!$inCart) Cart::createCart($id);
        } catch (Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        return Cart::updateCart($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::deleteCart($id);

        return redirect()->back();
    }
}
