@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-5 card">
                <img src="{{$product->image}}" alt="..." class="">
              </div>
              <div class="col-md-7">
                <div class="card-body">
                  <h5 class="card-title">{{$product->name}}</h5>
                 <hr>
                 <h2 class="mb-4"> <i class="fas fa-rupee-sign"></i>{{$product->price}}</h2>
                 <div class="justify-content-between d-flex">
                 <button class="btn btn-info ml-2 mr-5 p-2 w-50 addToCart" name="addToCart"><i class="fas fa-shopping-cart ml-1 mr-3"></i><a href="/cart/{{$product->id}}" style=" color: #ffffff;
                  text-decoration: none;"> Add to
                      Cart</a></button>
                 <button class="btn btn-info px-5" style="width : 50%"><i class="fas fa-bolt ml-1 mr-3"></i>Buy Now</button>
                </div>
                <h5 class="mt-4">Product Details</h5>
                <hr>
                 <p class="card-text">{{$product->description}}</p>
                </div>
              </div>
            </div>
          </div>

    </div>



@endsection