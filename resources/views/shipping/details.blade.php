@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light justify-content-center ">
        @if (count($shipping) == 0)
            <div class="card col-md-8" style="height: 100%;color:pink" >
                <h1> There is nothing to show</h1> 
                <div>
                    <a class="btn btn-info" type="button" href="/products"> Go back</a>
                </div>
            </div>
            
      @else
        <div class="col-md-12">
            <table class="table table-striped">
                <thead class="table-info">
                    <tr>

                        <th class='text-center'>
                            <h6> Name </h6>
                        </th>

                        <th class='text-center'>
                            <h6> phone </h6>
                        </th>

                        <th class='text-center'>
                            <h6> Address </h6>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipping as $ship)

                        <tr class="align-self-center">

                            <td class='text-center'> {{ $ship->name }} </td>
                            <td class='text-center'>{{ $ship->phone }}</td>

                            <td class='text-center'>{{ $ship->Address }}</td>


                        </tr>
                    @endforeach()

                </tbody>
            </table>

        </div>
    </div>
    @endif
@endsection
