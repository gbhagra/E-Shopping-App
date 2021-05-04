@extends('admin.layout')

@section('admin-content')
    <div class="col-md-8 mt-3">
        <table class="table table-striped">
            <thead class="table-info">
                <tr>
                    <th class='text-center'>
                        <h6> Thumbnail </h6>
                    </th>
                    <th class='text-center'>
                        <h6> Product Id </h6>
                    </th>

                    <th class='text-center'>
                        <h6> Product Name </h6>
                    </th>

                    <th class='text-center'>
                        <h6> Quantity </h6>
                    </th>
                    <th class='text-center'>
                        <h6> Price </h6>
                    </th>
                    <th class='text-center'>
                        <h6> Actions </h6>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="align-self-center">

                        <td class='text-center'> <img src="{{ $product->image }}" alt="thumbnail" height="50px"
                                width="50px">
                        </td>
                        <td class='text-center'> {{ $product->id }} </td>
                        <td class='text-center'>{{ $product->name }}</td>

                        <td class='text-center'>{{ $product->qty }}</td>
                        <td class='text-center'> ₹ {{ $product->price }}</td>
                        <td class='text-center'>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/product/update/{{ $product->id }}" class="btn btn-sm btn-dark"
                                    style="margin-left:5px " type="button"> Update </a>
                                <form action="/admin/products/{{ $product->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{-- {{ method_field('DELETE') }} --}}
                                    <button class="btn btn-sm btn-info ml-2" type="submit">Delete</button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @endforeach()

            </tbody>
        </table>
        <div class="paginate d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
