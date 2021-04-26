@inject('cart', 'App\Http\Controllers\CartController')
@extends('layouts.app')

@section('content')

    <div class="container w-100">

        <div class="row">

            <div class="col-md-8">
                <div class="card mt-3">
                    <h3>My cart</h3>
                    {{-- {{dd($total)}} --}}

                    @foreach ($products as $product)


                        {{--  --}}
                        {{-- <input type="text" onchange="this.form.submit()"> --}}

                        <hr>

                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <img src="{{ $product->image }}" alt="prd-img" height="100" width="100">
                                <div class="ml-5">
                                    <p>{{ $product->name }}</p>
                                    <strong>₹{{ $product->price }}</strong>
                                </div>
                            </div>
                            <div>
                                <form action="/cart/update/{{ $product->id }}" method="POST">
                                    {{ csrf_field() }}
                                    <label for="qty">
                                        {{ $cart->getQty($product->id) }}
                                    </label> <input type="number" name="qty" min="1" max="{{ $product->qty }}"
                                        onchange="this.form.submit()">
                                </form>
                            </div>
                            <a type="button" class="btn btn-danger mr-3" style="height:2.5rem; color:white "
                                href="/cart/delete/{{ $product->id }}">Delete</a>



                        </div>
                    @endforeach {{-- @endfor --}}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card  mt-3">
                    <h4 style="color: gray">Price Details</h4>
                    <hr>
                    <p> <span>Price</span> <span>₹{{ $price }}</span></p>
                    <p> <span>Discount</span> <span>10%</span></p>
                    <p> <span>Delivery Charges</span> <span>₹50</span></p>
                    <hr>
                    <span class="d-flex align-items-center justify-content-between">
                        <h3>Total Amount </h3><strong>₹{{ $total }}</strong>
                    </span>
                </div>
                <button class="btn btn-info mt-3 p-3"><a href="/order/confirmation" style="color: white"> Place Order</a></button>
            </div>
        </div>

    </div>

@endsection
