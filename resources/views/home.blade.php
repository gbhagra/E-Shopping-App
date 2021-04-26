@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <div class="row">
            @foreach ($products as $product)


  
                <div class="col-4">
                    <div class="card mb-4">
                        <a href="/products/{{$product->id}}"><img src="{{ $product->image }}" class="card-img-top" alt="..."></a>
                        <div class="card-body w-100">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <button class="btn btn-info ml-2 mr-2 p-2 addToCart" name="addToCart"><i class="fas fa-shopping-cart"></i><a href="/cart/{{$product->id}}" style=" color: #ffffff;
                                text-decoration: none;"> Add to
                                    Cart</a></button>
                                <button class="btn btn-info ml-5 p-2 buyNow" name="buyNow"><i class="fas fa-bolt ml-1 mr-1"></i>Buy Now</button>
                        </div>
                    </div>
                </div>
            @endforeach
           
        </div>
        {{-- <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div> --}}
    </div>
    <div class="paginate d-flex justify-content-center">
        {{ $products->links() }}
    </div>
    </div>
   
@endsection
