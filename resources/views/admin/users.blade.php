@extends('admin.layout')

@section('admin-content')
<div class="col-md-8">

<table class="table table-striped mt-3">
    <thead class="table-info">
        <tr>
           
            </th>
            <th class='text-center'>
                <h6> User Id </h6>
            </th>
            
            <th class='text-center'>
                <h6> User Name </h6>
            </th>
            
            {{-- <th class='text-center'>
                <h6> Quantity </h6>
            </th> --}}
            <th class='text-center'>
                <h6> email Id </h6>
            </th>
            <th class='text-center'>
                <h6> Actions </h6>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="align-self-center">
                
                <td class='text-center'> {{ $user->id }} </td>
                <td class='text-center'>{{ $user->name }}</td>
                
               
                <td class='text-center'>  {{ $user->email }}</td>
                <td class='text-center'>
                    <div class="d-flex justify-content-center">
                        <a href="/admin/users/{{ $user->id }}" class="btn btn-sm btn-dark"
                            style="margin-left:5px " type="button"> View Orders </a>
                        
                    </div>
                </td>

            </tr>
        @endforeach()

    </tbody>
</table>

</div>
{{-- <div class="paginate d-flex justify-content-center">
    {{$users->links()}}
</div> --}}

@endsection