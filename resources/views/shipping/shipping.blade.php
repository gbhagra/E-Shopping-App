@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light justify-content-center d-flex">


        <div class="container row">
            {{-- state and pincode to be removed --}}

            <div id="form">
                <form action="/shipping" method="POST">
                    {{ csrf_field() }}
                    <h1 class="col-md-12 mt-2 mb-4">Shipping Details</h1>
                    <input value="false" name="isNew" hidden></input>
                    <input value="{{ $shipping[0]->id }}" name="shipping_id" id="shipping_id" hidden></input>

                    <div class="form-group">
                        <div class="d-flex">
                            <div class="col-md-12">
                                <label for="name" class=" control-label">Name:</label>
                                <input type="text" class="form-control col-md-10 mb-3" id="name" name="name"
                                    placeholder="Name" value="{{ $shipping[0]->name }}" required autofocus readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="control-label ">Phone:</label>
                                <input type="text" class="form-control col-md-10 mb-3" id="phone" name="phone"
                                    placeholder="phone" value="{{ $shipping[0]->phone }}" required readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="control-label">Address Line 1:</label>
                            <input type="text" class="form-control col-md-12 mb-3" id="address" name="address"
                                placeholder="Address" value="{{ $shipping[0]->Address }}" required readonly>
                        </div>

                        <div class="col-md-12">
                            <button class="form-control  btn btn-info mt-3 col-6 ">Proceed to payment</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

    </div>
    @if (count($shipping) != 0)

        <div class="btn-group col-md-4 " style="height: 10%;width:100%; margin-left:45%">
            <button type="button" class="btn btn-primary dropdown-toggle navbar-right " data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Select Shipping Address
            </button>
            <div class="dropdown-menu">

                @foreach ($shipping as $ship)
                    <a class="dropdown-item option" href="#" id="{{ $ship->id }}">{{ $ship->singleLine }}</a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('shippingForm') }}" id="new">Add new shipping address</a>
            </div>
        </div>
    @endif

    <script>
        $('#new').click(function(e) {
            e.preventDefault();
            $('#form').html(`<form action="/shipping" method="POST">
                            {{ csrf_field() }}
                            <h1 class="col-md-12 mt-2 mb-4">Shipping Details</h1>
                            <input value="true" name="isNew" hidden></input>
                            <div class="form-group">
                                <div class="d-flex">
                               
                                    <div class="col-md-12">
                                        <label for="name" class=" control-label">Name:</label>
                                        <input type="text" class="form-control col-md-10 mb-3" name="name" placeholder="Name"
                                             required autofocus >
                                    </div>
                                    <div class="col-md-12">
                                        <label for="phone" class="control-label ">Phone:</label>
                                        <input type="text" class="form-control col-md-10 mb-3" name="phone" placeholder="phone"
                                             required >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="control-label">Address Line 1:</label>
                                    <input type="text" class="form-control col-md-12 mb-3" name="address" placeholder="Address"
                                         required >
                                </div>

                                <div class="col-md-12">
                                    <button class="form-control  btn btn-info mt-3 col-6 ">Proceed to payment</button>
                                </div>
                            </div>


                        </form>`);
        })

        $('.dropdown-item.option').click(function(e) {
            let id = e.target.id;
            console.log(id);
            $('#form').html(` <form action="/shipping" method="POST">
                        {{ csrf_field() }}
                        <h1 class="col-md-12 mt-2 mb-4">Shipping Details</h1>
                        <input value="false" name="isNew" hidden></input>
                        <input value="{{ $shipping[0]->name }}" name="shipping_id" id="shipping_id" hidden></input>

                        <div class="form-group">
                            <div class="d-flex">
                                <div class="col-md-12">
                                    <label for="name" class=" control-label">Name:</label>
                                    <input type="text" class="form-control col-md-10 mb-3" id="name" name="name"
                                        placeholder="Name" value="{{ $shipping[0]->name }}" required autofocus readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="phone" class="control-label ">Phone:</label>
                                    <input type="text" class="form-control col-md-10 mb-3" id="phone" name="phone"
                                        placeholder="phone" value="{{ $shipping[0]->phone }}" required readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="control-label">Address Line 1:</label>
                                <input type="text" class="form-control col-md-12 mb-3" id="address" name="address"
                                    placeholder="Address" value="{{ $shipping[0]->Address }}" required readonly>
                            </div>

                            <div class="col-md-12">
                                <button class="form-control  btn btn-info mt-3 col-6 ">Proceed to payment</button>
                            </div>
                        </div>


                    </form>`);
            $.ajax({
                'url': `/shipping/${id}`,
                'type': 'GET',
                'success': function(response) {
                    // console.log(response);
                    $('#name').val(response.name);
                    $('#phone').val(response.phone);
                    $('#address').val(response.address);
                    $('#shipping_id').val(response.id);


                }
            });
        });

    </script>

@endsection
