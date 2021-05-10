<?php

namespace App\Http\Controllers;

use App\Cart;
use App\product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ProductSeeder;

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
        try {
            $products = product::paginate(9);
            if (Auth::check()) {
                foreach ($products as $product) {
                    $product->incart = $this->inCart($product->id);
                }
            }
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
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
        try {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'name' => 'required|alpha_num|min:2',
                'description' => 'required',
                'price' => 'required|numeric|min:1',
                'quantity' => 'required|numeric|min:1'

            ]);
            $extension = "." . $request->image->getClientOriginalExtension();
            $name = basename($request->image->getClientOriginalName(), $extension) . time();
            $name = $name . $extension;

            Storage::disk('public')->putFileAs('uploads', $request->image, $name);

            $path = '/uploads/' . $name;


            Product::createProduct($request, $path);
            \Session::flash('message', "Product added successfully");
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }

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
        return  Product::inCart($id);
    }

    public static function show($id)
    {
        //
        try {
            //code...
            $inCart = false;
            $product = product::getProduct($id);
            if (Auth::check()) {
                $inCart = Product::inCart($id);
            }
        } catch (\Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
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
        $product = product::getProduct($id);
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
        try {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000',
                'name' => 'required|alpha_num|min:2',
                'description' => 'required',
                'price' => 'required|numeric|min:1',
                'quantity' => 'required|numeric|min:1'

            ]);

            $product = product::getProduct($id);
            $path = $product->image;
            // add check for extension of file
            if ($request->image) {
                $extension = "." . $request->image->getClientOriginalExtension();
                $name = basename($request->image->getClientOriginalName(), $extension) . time();
                $name = $name . $extension;


                Storage::disk('public')->putFileAs('uploads', $request->image, $name);
                $path = '/uploads/' . $name;
            }

            Product::Productupdate($request, $product, $path);
            \Session::flash('message', 'Product updated successfully');
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
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
