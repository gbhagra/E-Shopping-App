@extends('layouts.app')







@section('content')
    <div class="album py-5 bg-light justify-content-center d-flex">
        <div class="container row  "style="margin-left: 15rem;">
            <form action="/shipping" method="POST">
                {{ csrf_field() }}
                <h1 class="col-md-12 mt-2 mb-4">Shipping Details</h1>
                <div class="form-group">
                    <div class="d-flex">
                        <div class="col-md-12">
                            <label for="name" class=" control-label">Name:</label>
                            <input type="text" class="form-control col-md-10 mb-3" name="name" placeholder="Name" required
                                autofocus>
                        </div>
                        <div class="col-md-12">
                            <label for="phone" class="control-label ">Phone:</label>
                            <input type="text" class="form-control col-md-10 mb-3" name="phone" placeholder="phone"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="control-label">Address Line 1:</label>
                        <input type="text" class="form-control col-md-12 mb-3" name="address" placeholder="Address"
                            required>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-12">
                            <label for="State" class="control-label">State:</label>
                            <input type="text" class="form-control col-md-6 mb-3" name="state" placeholder="state" required>
                        </div>

                        <div class="col-md-12">
                            <label for="pin" class="control-label">Pincode:</label>
                            <input type="text" class="form-control col-md-10 mb-3" name="pincode" placeholder="Pincode"
                                required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="form-control  btn btn-info mt-3 col-6 ">Proceed to payment</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
