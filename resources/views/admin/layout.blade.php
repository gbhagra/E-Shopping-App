@extends('layouts.app')
    @section('content')


    <div class="container-fluid">
        <div class="row">
            
            <nav class="col-md-2 d-none d-md-block bg-light sidebar" style="height: 94vh;">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                       
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/create' ? 'active' : '' }}"  href="/admin/create">
                                
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/products' ? 'active' : '' }}" href="{{ url('/admin/products') }}">
                                
                                Show Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/users' ? 'active' : '' }}" href="{{ url('/admin/users') }}">
                                
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/orders' ? 'active' : '' }}" href="{{ url('/admin/orders') }}">
                               Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="col-md-8">
                @yield('admin-content')

            </div>
            {{-- @yield('content') --}}
        </div>
    </div>
{{--    
    @include('layouts.footer') --}}


    
@endsection()
