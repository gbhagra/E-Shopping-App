@extends('layouts.app')

@section('content')

    <div class="container w-100">

        <div class="row">


            @if (count($cartItems) == 0)
                <div style="margin-top: 5%;margin-left:30%">

                    <img src="https://freesvg.org/img/shopping-bag1.png" />

                    <h4>Hey, it feels so light</h4>
                    <p>There is nothing in your cart let's add some items</p>
                    <a type="button" class="mycart" href="/products">ADD ITEMS</a>
                </div>
            @else
            {{-- {{dd($cartItems)}} --}}
                <div class="col-md-8">
                    <div class="card mt-3">
                        <h3>My cart</h3>

                        @foreach ($cartItems as $cartItem)

                            <div class="" id="element{{ $cartItem->product_id }}">
                                <hr>

                                <div class="d-flex align-items-center justify-content-between">

                                    <div class="d-flex">
                                        <img src="{{ $cartItem->product->image }}" alt="prd-img" height="100" width="100">
                                        <div class="ml-5">
                                            <p>{{ $cartItem->product->name }}</p>
                                            <strong>₹{{ $cartItem->product->price }}</strong>
                                        </div>
                                    </div>
                                    <div>
                                        <form>
                                            {{ csrf_field() }}
                                            <label for="qty" id="quantity-{{ $cartItem->product->id }}">
                                                {{ $cartItem->quantity }}
                                            </label> <input type="number" class="qty" name="qty" min="1"
                                                max="{{ $cartItem->product->qty }}" id="{{ $cartItem->product->id }}">
                                        </form>
                                    </div>
                                    <a type="button" class="btn btn-danger mr-3 Delete" style="height:2.5rem; color:white "
                                        href="/cart/delete/{{ $cartItem->product->id }}"
                                        id="{{ $cartItem->product->id }}">Delete</a>



                                </div>
                            </div>
                        @endforeach
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
                            $('#total').text('₹'+response.total);
                            $('#price').text('₹'+response.price);
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
