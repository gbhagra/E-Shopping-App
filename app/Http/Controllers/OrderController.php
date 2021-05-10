<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code...
        $orders = Orders::all();

        return view('admin.orders', compact('orders'));
    }

    public function checkout()
    {
        return Orders::checkout();
    }

    public function store()
    {
        $order_id = Orders::storeOrder();
        return view('summary', compact('order_id'));
    }

    public function update($id, $status)
    {
        # code...

        $order = Orders::getOrder($id);
        $order->status = $status;
        $order->save();


        return $order->status;
    }

    public function show() // shows user's placed orders
    {
        # code...
        $user = Auth::user();
        $orders = Orders::showOrders();
        
        return view('orders', compact('orders'), compact('user'));
    }
}
