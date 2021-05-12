@extends('admin.layout')

@section('admin-content')
    <div class="col-md-8">
        <table class="table table-striped">
            <thead class="table-info">
                <tr>

                    <th class='text-center'>
                        <h6> Order Id </h6>
                    </th>

                    <th class='text-center'>
                        <h6> User Id </h6>
                    </th>

                    <th class='text-center'>
                        <h6> Quantity </h6>
                    </th>
                    <th class='text-center'>
                        <h6> Change Status </h6>
                    </th>
                    <th class='text-center'>
                        <h6> Current Status </h6>
                    </th>
                </tr>
            </thead>`
            <tbody>
                @foreach ($orders as $order)
                
                    <tr class="align-self-center">

                        <td class='text-center'> {{ $order->order_id }} </td>
                        <td class='text-center'>{{ $order->user_id }}</td>

                        <td class='text-center'>{{ $order->quantity }}</td>
                        <td class='text-center'>
                            <select name="status" class="status pt-1 pb-1" id="{{ $order->order_id }}">

                                <option value="0"> Pending </option>
                                <option value="1"> Confirmed </option>
                                <option value="2"> Dispatched </option>
                                <option value="3"> Delivered </option>
                            </select>
                        </td>
                        <td class='text-center'>
                            @if ($order->status == 1) {{-- confirmed --}}
                                <div class="" id="status{{ $order->order_id }}">
                                    Confirmed
                                </div>
                            @elseif( $order->status == 2 ) {{-- dispatched --}}
                                <div class="" id="status{{ $order->order_id }}">
                                    Dispatched
                                </div>
                            @elseif ($order->status == 3) {{-- delivered --}}
                                <div class="" id="status{{ $order->order_id }}">
                                    Delivered
                                </div>
                            @elseif ($order->status == 0){{-- pending --}}
                                <div class="" id="status{{ $order->order_id }}">
                                    pending
                                </div>
                            @endif
                        </td>

                    </tr>
                @endforeach()

            </tbody>
        </table>
        <script>
            $('.status').on('change', function(e) {
                if (confirm("Do yo want change the status")) {
                    let status = e.target.value;
                    let orderId = e.target.id;
                    $.ajax({
                        url: `orders/status/${orderId}/${status}`,
                        type: "GET",
                        success: function(response) {
                            $(`#status${orderId}`).text(response);

                            if (response == 1) {
                                document.getElementById(`status${orderId}`).className =
                                    // "alert alert-success";
                                $(`#status${orderId}`).text('confirmed');
                            } else if (response == 2) {
                                document.getElementById(`status${orderId}`).className =
                                    // "alert alert-warning";
                                $(`#status${orderId}`).text('Dispatched');
                            } else if (response == 3) {
                                document.getElementById(`status${orderId}`).className =
                                    // "alert alert-info";
                                $(`#status${orderId}`).text('Delivered');
                            } else {
                                document.getElementById(`status${orderId}`).className =
                                    // "alert alert-danger";
                                $(`#status${orderId}`).text('Pending');
                            }
                        }
                    });
                }
            });

        </script>
    @endsection
