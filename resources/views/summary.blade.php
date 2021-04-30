@extends('layouts.app')

@section('content')
    <div class="conatiner row ">
        <div class="col-12" style="margin-left: 600px;margin-top:200px">
            <h2 class="col-12">You have successfully placed your order</h2>
            <h3 class="col-12" style="margin-left: 120px">Your Order ID is :{{$order_id}}</h3>
            <a type="button" href="/products" class="btn btn-primary mt-5 col-md-2" style="margin-left: 100px">Continue shopping</a>
        </div>

    </div>

@endsection
