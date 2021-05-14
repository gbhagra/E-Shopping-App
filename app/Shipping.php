<?php

namespace App;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    //
    protected $guarded = [];

    public static function store(Request $request)
    {
        # code...
        try {
            //code...


            $shipping = Shipping::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
        return $shipping;
    }

    public static function singleLineAddress()
    {
        # code...
        try {
            //code...
            $user_id = Auth::user()->id;
            $shipping = Shipping::where('user_id', $user_id)->latest()->get();
            foreach ($shipping as $ship) {
                $ship->singleLine = substr($ship->Address, 0, 50);
            }
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }


        return $shipping;
    }

    public static function getShipping($id)
    {
        # code...
        try{
            $shipping = Shipping::find($id);

        }catch (Exception $e) {

            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
        $shipping = Shipping::find($id);

        return response()->json([
            'name' => $shipping->name,
            'phone' => $shipping->phone,
            'address' => $shipping->Address,
            'id' => $shipping->id
        ]);
    }
}
