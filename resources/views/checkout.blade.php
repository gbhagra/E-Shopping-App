@extends('layouts.app')
@inject('cart', 'App\Http\Controllers\CartController')

@section('content')
    <div class="container">

        <div class="album py-5 b-light justify-content-center d-flex">
            <div class="row">
                <div class="card col-md-12">
                    <h3>Delivering To:</h3>
                    <p><strong>Name:</strong>{{ $shipping->name }}</p>
                    <p><strong>Phone No:</strong>{{ $shipping->phone }}</p>
                    <p><strong>Address:</strong>{{ $shipping->Address }}</p>
 
                </div>
                <div class="col-md-12 w-100 d-flex">

                    <h5 class="col-md-6">Items</h5>
                    <h5 class="col-md-6 ">qty</h5>

                </div>

                <div class="col-12">
                    {{-- {{dd($cart->index()->products)}} --}}
                    @foreach ( $cart->index()->products as $product)
                    

                        {{--  --}}
                        {{-- <input type="text" onchange="this.form.submit()"> --}}

                        <hr>

                        <div class="d-flex align-items-center justify-content-start">
                            <div class="d-flex">
                                <img src="{{ $product->image }}" alt="prd-img" height="100" width="100">
                                <div class="ml-5">
                                    <p>{{ $product->name }}</p>
                                    <strong>₹{{ $product->price }}</strong>
                                </div>
                            </div>
                            
                            <div style="margin-left:22.5rem ">
                                {{$cart->getQty($product->id)}}
                            </div>
                         



                        </div>
                    @endforeach {{-- @endfor --}}
                </div>

            </div>

        </div>


    </div>



@endsection
