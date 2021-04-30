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
                    @foreach ($cart->index()->products as $product)


                        {{--  --}}
                        {{-- <input type="text" onchange="this.form.submit()"> --}}

                        <hr>

                        <div class="d-flex align-items-center justify-content-start">
                            <div class="d-flex">
                                <img src="{{ $product->image }}" alt="prd-img" height="100" width="100">
                                <div class="ml-5">
                                    <p>{{ $product->name }}</p>
                                    <h5>₹{{ $product->price }}</h5>
                                </div>
                            </div>

                            <div style="margin-left:22.5rem ">
                                {{ $cart->getQty($product->id) }}
                            </div>




                        </div>
                    @endforeach {{-- @endfor --}}
                    <hr>

                        
      
                        <div class="d-flex">
                            <h4>Amount to be paid</h4>
                            <h4 style="margin-left:22.5rem ">₹{{ $cart->index()->total }}</h4>
                        </div>
                        <hr>
                        
                        <ul style="row list-group;padding: 0px;"list-group">
                           <li class="list-group-item"><h3>Payment options</h3>
                           </li>
                            <li class="list-group-item"> <input type="radio" name="payment-method" id="upi"> UPI </li>
                            <li class="list-group-item"><input type="radio" name="payment-method" id="card"> Credit/Debit
                                Card</li>
                            <li class="list-group-item"><input type="radio" name="payment-method" id="wallets"> Wallets</li>
                            <li class="list-group-item"><input type="radio" name="payment-method" id="cod"> Cash on delivery
                            </li>

                        </ul>
                        <div class="justify-content-end d-flex">
                            <a type="button" class="btn btn-danger mr-1 btn-lg" href="/cart"> Cancel</a>
                            <a type="button" href="/order/summary" class="btn btn-warning mr-1 btn-lg" href="/cart"> Place Order</a>{{-- to be directed to congrats page --}}
                        </div>
                   


                </div>

            </div>

        </div>


    </div>



@endsection
