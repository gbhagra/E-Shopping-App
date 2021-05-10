<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Shipping extends Model
{
    //
    protected $guarded = [];

    public static function store(Request $request)
    {
        # code...
        try {
            //code...
            Shipping::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'address' => $request->address . " " . $request->pincode . " " . $request->state,
                'phone' => $request->phone
            ]);
        } catch (Exception $e) {
            return view('layouts.errors', ['errors' => $e->getMessage()]);
        }
    }
}
