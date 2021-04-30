@extends('admin.layout')

@section('admin-content')
    <h1>Form</h1>

    <form class="mt-3" method="POST" action='/admin/product' enctype='multipart/form-data'>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name='name' id="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name='description' id="description" rows="5"></textarea>
        </div>
        <div class="d-flex">
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name='price' id="price">
        </div>
        <div class="form-group ml-5">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name='quantity' id="quantity">
        </div>
    </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" name='image' id="image">
        </div>

        <button class="btn btn-primary py-2 mt-3 px-5" type="submit"> Submit </button>
    </form>


@endsection
