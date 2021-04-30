@extends('admin.layout')

@section('admin-content')

    <form class="mt-3" method="POST" action='/admin/product/update/{{$product->id}}' enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name='name' id="name" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name='description' id="description" rows="5" >{{$product->description}}</textarea>
        </div>
        <div class="d-flex">
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name='price' id="price" value="{{$product->price}}">
            </div>
            <div class="form-group ml-5">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name='quantity' id="quantity" value="{{$product->qty}}">
            </div>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name='image' id="image">
        </div>

        <button class="btn btn-dark py-2 mt-3 px-5" type="submit"> Submit </button>
    </form>
@endsection
