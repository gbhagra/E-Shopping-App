<?php

namespace App\Http\Controllers;

use App\Cart;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function index()
    {
        //
        $products = product::paginate(9);
        if (Auth::check()) {
            foreach ($products as $product) {
                $product->incart = Auth::user()->Cart()->where('product_id', $product->id)->get()->isNotEmpty();
            }
        }

        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //]
        return view('admin.productForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'

        ]);
        $extension = "." . $request->image->getClientOriginalExtension();
        $name = basename($request->image->getClientOriginalName(), $extension) . time();
        $name = $name . $extension;

        Storage::disk('public')->putFileAs('uploads', $request->image, $name);

        $path = '/uploads/' . $name;


        Product::create([
            'name' =>  $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->quantity,
            'image' => $path
        ]);
        \Session::flash('message', "Product added successfully");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */

    public function inCart($id)
    {
        # code...

        $inCart = Auth::User()->cart()->where('product_id', $id)->get()->isNotEmpty();
        return $inCart;
    }

    public static function show($id)
    {
        //
        try {
            //code...
            $inCart = false;
            $product = product::find($id);
            if (Auth::check()) {
                $inCart = Auth::User()->cart()->where('product_id', $id)->get()->isNotEmpty();
            }
        } catch (\Exception $e) {

            dd($e);
        }

        return view('detailed', compact('product'), compact('inCart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = product::find($id);
        return view('admin.update', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, product $product)
    {
        //


        $product = product::find($id);
        $path = $product->image;
        // add check for extension of file
        if ($request->image) {
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;


            Storage::disk('public')->putFileAs('uploads', $request->image, $name);
            $path = '/uploads/' . $name;
        }

        $product->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'qty' => $request->quantity, 'image' => $path]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
