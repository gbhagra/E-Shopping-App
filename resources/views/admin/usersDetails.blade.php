@extends('admin.layout')

@section('admin-content')
    <div class="col-md-6 mt-5">

        <table class="table table-striped border border-info ">

            <thead class="table-info">
                <tr>

                    <th class='text-center'>Order Id</th>
                    <th class='text-center'>Product Id</th>
                    <th class='text-center'>Quantity</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                        {{-- {{dd($order)}} --}}

                        <td class='text-center'>{{ $order->order_id }}</td>
                        <td class='text-center'>{{ $order->product_id }}</td>
                        <td class='text-center'>{{ $order->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <div class="col-md-4">
        <div class="card-body border border-info mt-5 rounded">
            <h4>User's Details</h4>
            <hr>
            <p><strong>Name:</strong> {{$user->name}}</p>
            <hr>
            <p><strong>User Id:</strong> {{$user->id}}</p>
            <hr>
            <p><strong>Email Id:</strong> {{$user->email}}</p>
            <hr>
            <p><strong>Created at:</strong> {{$user->created_at}}</p>

        </div>
    </div>

@endsection
