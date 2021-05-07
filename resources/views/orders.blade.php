@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4">

            <div class="card-body border border-info mt-5 rounded">
                <h4>User's Details</h4>
                <hr>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <hr>
                <p><strong>User Id:</strong> {{ $user->id }}</p>
                <hr>
                <p><strong>Email Id:</strong> {{ $user->email }}</p>
                <hr>
                <p><strong>Created at:</strong> {{ $user->created_at }}</p>

            </div>

        </div>
        <div class="col-md-8 mt-5">

            <table class="table table-striped border border-info ">

                <thead class="table-info">
                    <tr>
                        <th class="text-center">Thumbnail</th>
                        <th class='text-center'>Order Id</th>
                        <th class='text-center'>Product Id</th>
                        <th class='text-center'>Quantity</th>
                        <th class="text-center">Price (<i class="fas fa-rupee-sign"></i>)</th>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($orders as $order)
                    
                        <tr>
                            <td><img src="{{$order->image}}" alt="" height="150px" width="150px"></td>
                            <td class='text-center'>{{ $order->id }}</td>
                            <td class='text-center'>{{ $order->product_id }}</td>
                            <td class='text-center'>{{ $order->quantity }}</td>
                            <td class='text-center'>{{ $order->price }}</td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
