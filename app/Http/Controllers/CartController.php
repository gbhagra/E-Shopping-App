<?php

namespace App\Http\Controllers;

use App\Cart;
use App\product;
use Error;
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
        //
        //item -> prod_id
        // prod_id -> product
        //products push product
        //compact products -> >>>>>>

        // $carts = Auth::user()->Cart()->get();

        // $products = [];
        // foreach ($carts as $cart) {


        //     $products[] = product::find($cart->product_id);
        // }

        //

        // $price = 0;
        // foreach ($products as $product) $price += $product->price * $product->qty;
        $products = Cart::price()[0];
        $price = Cart::price()[1];
        $total = Cart::price()[2];
        // dd($total);
        return view('cart', ['products' => $products, 'price' => $price, 'total' => $total]);
    }
    public function getTotal()
    {
        # code...
        $price = Cart::price()[1];
        $total = Cart::price()[2];
        return ['total'=>$total,'price'=>$price];
    }

    public function getQty($prod_id)
    {
        $prod = Auth::user()->Cart()->where('product_id', $prod_id)->get();
        return $prod[0]->quantity;
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
        // dd(Auth::user());
        $inCart = Auth::User()->cart()->where('product_id',$id)->get()->isNotEmpty();
        if(!$inCart){
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => 1

        ]);
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
        //find product -> if product quantity > requested quantity 
        //->get user's cart 
        //->find the product and upate its quantity
        $prod = product::find($id);
        if($request->qty <1)return 1;
        if ($request->qty <= $prod->qty) {
            $cart = Auth::user()->Cart();
            $cart->where('product_id', $id)->update(['quantity' => $request->qty]);
            return $request->qty;
        }
        // dd($cart);

        return "Only ". $prod->qty ." in stock";
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
        Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->delete();

        return redirect()->back();
    }
}
