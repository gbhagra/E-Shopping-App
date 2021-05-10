<style>
    .card {
        margin: auto;
        border-radius: 5%;
    }

    .card-img-top {
        max-height: 25vh;
        object-fit: contain;
        padding: 40px;

    }

    .card-body {
        flex-grow: 0;
    }

</style>

@extends('layouts.app')
{{-- @inject('Cart','App\Http\Controllers\ProductController' ) --}}
@section('content')
    <div class="container">
        <div class="alert alert-info" role="alert" id="alert" style="visibility:hidden">
            Product has been added to your cart!

            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <div id="carouselExampleIndicators" class="carousel slide mb-5" style="height: 50vh" data-ride="carousel">
            <ol class="carousel-indicators" style="height: 50vh">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ $products[1]->image }}" alt="First slide" style="height: 50vh">
                    <div class="carousel-caption">
                        <h3>Welcome to OneStop Shop</h3>
                        <p>One Stop for every products you need</p>
                        <a type="button" href="/" class="btn btn-outline-light"> Start Shopping </a>
                    </div>

                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center w-100 h-100" style="background-image: url('/black.png')">
                        <img class="d-block w-50" src="https://picsum.photos/536/354" alt="Second slide"
                            style="height: 50vh">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex justify-content-center w-100 h-100" style="background-image: url('/black.png')">
                        <img class="d-block w-50" src="https://picsum.photos/540/350" alt="Second slide"
                            style="height: 50vh">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <h1>Deals of the day</h1>

        <div class="row mt-4">
            @foreach ($products as $product)
                <div class="col-4">
                    <div class="card mb-4 " style="box-shadow: 1px 0px #888888;">
                        <a href="/products/{{ $product->id }}"><img src="{{ $product->image }}" class="card-img-top"
                                alt="..." style="padding:20px"></a>
                        <div class="card-body w-100">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-title p-0"><strong style="color:green"> ₹{{ $product->price }}</strong><span
                                    style=" text-decoration: line-through;"> ₹{{ $product->price + 100 }}</span></h6>
                            @if (Auth::check() && $product->incart)

                                <button style="color: white;background:#ff9f00 " class="btn ml-2 mr-2 p-2 addToCart "
                                    id="{{ $product->id }}" disabled> Already in cart</button>
                                <a type="button" href="/cart" class="btn ml-5 p-2 buyNow" name="buyNow"
                                    style="color:white;background:#fb641b"><i class="fas fa-bolt ml-1 mr-1"></i>Buy Now</a>
                            @elseif ($product->qty == 0)

                                <button style="color: white;background:#ff9f00 " class="btn ml-2 p-3 w-100 addToCart "
                                    id="{{ $product->id }}" disabled> Out of stock</button>

                            @else
                                <button style="color: white;background:#ff9f00 " class="btn ml-2 mr-2 p-2 addToCart"
                                    id="{{ $product->id }}"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</button>

                                <a type="button" href="/cart/{{ $product->id }}" class="btn ml-5 p-2 buyNow" name="buyNow"
                                    style="color:white;background:#fb641b"><i class="fas fa-bolt ml-1 mr-1"></i>Buy Now</a>

                                {{--  --}}
                            @endif



                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
    <div class="paginate d-flex justify-content-center">

        {{ $products->links() }}
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous"></script>

    <script>
        $(".addToCart").click(function(e) {

            console.log(e.target);
            let productID = e.target.id;

            $.ajax({
                'url': `/cart/${productID}`,
                'type': `GET`,
                'success': function() {

                    $('#alert').css("visibility", "visible");
                    $(`#${productID}`).prop('disabled', true).text('Already in cart');

                }
            })
        });
        $(".close").click(function() {
            $.ajax({
                'success': function() {
                    $('#alert').css("visibility", "hidden");
                }
            })
        })

    </script>

@endsection
