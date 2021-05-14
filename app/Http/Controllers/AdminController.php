<?php

namespace App\Http\Controllers;

use App\product;
use App\User;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd(1);
        return view('admin.layout');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProducts()
    {
        try {
            //code...
            $products = \App\Product::paginate(10);
        } catch (Exception $e) {
            //throw $th;
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }

        return view('admin.products', compact('products'));
    }

    public function showUsers()
    {
        # code...
        try {
            //code...
            $users = User::all();
        } catch (Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
        return view('admin.users', compact('users'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        try {
            //code...
            $product = product::getProduct($id);
        } catch (Exception $e) {
      
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }

        return view('admin.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        try {
            product::destroy($request->id);
        } catch (Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
        return redirect()->back();
    }
}
