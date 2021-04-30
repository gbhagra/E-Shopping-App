
@inject('cart', 'App\Http\Controllers\CartController')

@extends('layouts.app')

@section('content')

    <div class="container w-100">

        <div class="row">


            @if (empty($products))
                <div style="margin-top: 5%;margin-left:30%">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-cart ml-5 mb-3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                      </svg> --}}
                      <img src="https://freesvg.org/img/shopping-bag1.png"/>
                      
                      <h4>Hey, it feels so light</h4>
                    <p>There is nothing in your cart let's add some items</p>
                    <a type="button" class="mycart" href="/products">ADD ITEMS</a>
                </div>
            @else
                <div class="col-md-8">
                    <div class="card mt-3">
                        <h3>My cart</h3>
                        {{-- {{dd($total)}} --}}



                        @foreach ($products as $product)


                            {{--  --}}
                            {{-- <input type="text" onchange="this.form.submit()"> --}}


                            <div class="" id="element{{ $product->id }}">
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
                                        <form>
                                            {{ csrf_field() }}
                                            <label for="qty" id="quantity-{{ $product->id }}">
                                                {{ $cart->getQty($product->id) }}
                                            </label> <input type="number" class="qty" name="qty" min="1"
                                                max="{{ $product->qty }}" id="{{ $product->id }}">
                                        </form>
                                    </div>
                                    <a type="button" class="btn btn-danger mr-3 Delete" style="height:2.5rem; color:white "
                                        href="/cart/delete/{{ $product->id }}" id="{{ $product->id }}">Delete</a>



                                </div>
                            </div>
                        @endforeach {{-- @endfor --}}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card  mt-3">
                        <h4 style="color: gray">Price Details</h4>
                        <hr>
                        <p> <span>Price</span> <span id="price">₹{{ $price }}</span></p>
                        <p> <span>Discount</span> <span>10%</span></p>
                        <p> <span>Delivery Charges</span> <span>₹50</span></p>
                        <hr>
                        <span class="d-flex align-items-center justify-content-between">
                            <h3>Total Amount </h3><strong id="total">₹{{ $total }}</strong>
                        </span>
                    </div>
                    <a type="button" href="/shipping" class="btn btn-primary mt-3 p-3" style="color:white"> Place Order</a>
                </div>
        </div>

    </div>



    <script>
        $(".Delete").click(function(e) {
            e.preventDefault();
            console.log(e.target.id);
            let productId = e.target.id;
            $.ajax({
                'url': `/cart/delete/${productId}`,
                'type': 'GET',
                'success': function() {
                    $(`#element${productId}`).remove();
                    $.ajax({
                        url: `/cart/total/${productId}`,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            $('#total').text(response.total);
                            $('#price').text(response.price);
                        }
                    })
                }
            })

        });

        $(`.qty`).on('change', function(e) {
            // console.log(e.target);
            let productID = e.target.id;
            let val = e.target.value;
            $.ajax({
                url: `/cart/update/${productID}`,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "qty": val
                }, // when quantity upadtes update price and total as well
                success: function(response) {
                    $(`#quantity-${productID}`).text(response);
                    $.ajax({
                        url: `/cart/total/${productID}`,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            $('#total').text(response.total);
                            $('#price').text(response.price);
                        }
                    })
                }
            })
        })

    </script>
    @endif
@endsection
