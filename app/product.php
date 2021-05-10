<?php

namespace App;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //

    protected $guarded = [];

    public static function createProduct(Request $request, $path)
    {
        # code...
        try {
            Product::create([
                'name' =>  $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'qty' => $request->quantity,
                'image' => $path
            ]);
        } catch (\Exception $e) {
            return view('layouts.errors', ["errors" => $e->getMessage()]);
        }
    }
    public static function inCart($id)
    {
        # code...
        $inCart = Auth::User()->cart()->where('product_id', $id)->get()->isNotEmpty();
        return $inCart;
    }

    public static function Productupdate(Request $request, $product, $path)
    {
        # code...
        $product->update(['name' => $request->name, 'description' => $request->description, 'price' => $request->price, 'qty' => $request->quantity, 'image' => $path]);
    }
    public static function getProduct($id)
    {
        # code...
        $product = product::findOrFail($id);
        return $product;
    }
}
