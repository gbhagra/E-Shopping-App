<?php

namespace App\Http\Controllers;

use App\Shipping;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Util\Json;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # code...

        return view('shipping.shippingForm');
    }





    public function address()
    {
        //
        if ((auth()->user()->shipping()->get()->isEmpty())) {
            return redirect('shippingForm');
        }

        $shipping = Shipping::singleLineAddress();

        return view('shipping.shipping', ['shipping' => $shipping]);
    }

    public function getShipping($id)
    {
        # code...
      return Shipping::getShipping($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //code...
            $this->validate($request, [
                'name' => 'required|min:2',
                'address' => 'required|min:5',
                'phone' => 'required|numeric'
            ]);

            $route = '/order/confirmation/';

            if ($request->isNew == "true") {
                $shipping = Shipping::store($request);
                $route = '/order/confirmation/' . $shipping[0]->id;
            } else {
                $id = $request->shipping_id;
                $route = '/order/confirmation/' . $id;
            }
        } catch (Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
        return redirect($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
        try {
            //code...
            $shipping = Auth::user()->shipping;
        } catch (Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }

        return view('shipping.details', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping $shipping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}
