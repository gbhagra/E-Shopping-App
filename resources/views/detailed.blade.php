@extends('layouts.app')

@section('content')


    <div class="container mt-5">


        <div class="row">
            <div class="col-md-5">
                <div class="prod-img" style="border: none;">
                    <img src="{{ $product->image }}" alt="..." class="">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <hr>
                    <h2 class="mb-4"> <i class="fas fa-rupee-sign"></i>{{ $product->price }}</h2>
                    <div class="justify-content-between d-flex">
                        @if ($product->qty <= 0) <button
                                style="color: white;background:#ff9f00 " class="btn ml-2 p-3 w-100 addToCart "
                                id="{{ $product->id }}" disabled> Out of
                                stock</button>
                        @else
                            @if (Auth::check() && !$inCart)
                                <button class="btn ml-2 mr-5 p-2 w-50 addToCart" name="addToCart"
                                    style="color: white;background:#ff9f00 " id="{{ $product->id }}"><i
                                        class="fas fa-shopping-cart ml-1 mr-3"></i> Add to
                                    Cart</button>
                                <a type="button" href="/cart/{{ $product->id }}" class="btn px-5"
                                    style="width : 50%;color:white;background:#fb641b"><i
                                        class="fas fa-bolt ml-1 mr-3"></i>Buy
                                    Now</a>

                            @elseif (!(Auth::check()))

                                <button class="btn ml-2 mr-5 p-2 w-50 addToCart" name="addToCart"
                                    style="color: white;background:#ff9f00 " id="{{ $product->id }}"><i
                                        class="fas fa-shopping-cart ml-1 mr-3"></i> Add to
                                    Cart</button>
                                <a type="button" href="/cart/{{ $product->id }}" class="btn px-5"
                                    style="width : 50%;color:white;background:#fb641b"><i
                                        class="fas fa-bolt ml-1 mr-3"></i>Buy
                                    Now</a>


                            @else
                                <button class="btn ml-2 mr-5 p-2 w-50 addToCart disabled" name="addToCart"
                                    style="color: white;background:#ff9f00 "><i class="fas fa-shopping-cart ml-1 mr-3"></i>
                                    Already in Cart</button>

                                <a type="button" href="/cart" class="btn px-5"
                                    style="width : 50%;color:white;background:#fb641b"><i
                                        class="fas fa-bolt ml-1 mr-3"></i>Buy
                                    Now</a>
                            @endif
                        @endif
                        {{-- <button
                                    class="btn btn-info ml-2 mr-5 p-2 w-50 addToCart {{ $inCart == true ? 'disabled' : '' }} " onclick="location.href='/cart/{{ $product->id }}'"
                                    name="addToCart"></button> --}}


                    </div>

                    <h5 class="mt-4">Product Details</h5>
                    <hr>
                    <h5>Qty Left:-{{ $product->qty }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>


    </div>



    <script>
        $(".addToCart").click(function(e) {
            e.preventDefault();
            console.log(e.target.id);
            let productID = e.target.id;

            $.ajax({
                'url': `/cart/${productID}`,
                'type': `GET`,
                'success': function() {

                    $(`#${productID}`).prop('disabled', true).text('Already in cart');

                }
            })
        });

    </script>

@endsection
