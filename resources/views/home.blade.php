@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach ($products as $product)



                <div class="col-4">
                    <div class="card mb-4">
                        <img src="{{ $product->image }}" class="card-img-top" alt="...">
                        <div class="card-body w-100">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <a href=""><button class="btn btn-primary ml-1 mr-5 addToCart" name="addToCart"> Add to
                                    Cart</button>
                                <button class="btn btn-primary ml-5 buyNow" name="buyNow">Buy Now</button></a>
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
