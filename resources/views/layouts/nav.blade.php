
<div class="navbar sticky-top navbar-dark bg-primary shadow-sm ">
    <div class="container d-flex justify-content-between">
      <a href="/products" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>OneStop Shop</strong>
      </a>
      <ul class="d-flex flex-column flex-md-row align-items-center p-1 list-group">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li class="nav navbar-nav navbar-right "><a href="{{ route('login') }}" class="nav-link active">Login &nbsp;</a></li>
            <li class="nav navbar-nav navbar-right"><a href="{{ route('register') }}" class="nav-link active">Register</a></li>
          
            
        @else
                @if( Auth::user()->admin )
                <a href="/admin/home" role="button" aria-expanded="false" class="text-light mr-2" >
                    {{ Auth::user()->name }} 
                </a>
                @else
                <a href="/" role="button" aria-expanded="false" class="text-light mr-2" >
                    {{ Auth::user()->name }} 
                </a>
                @endif
               
                <a href="/cart " role="button" aria-expanded="false" class="text-light mr-2" >
                    Cart 
                </a>
             
                    <div >
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="text-light ml-2">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>



                    </div>
              
          
        @endif
    </ul>
    </div>
  </div>
</header>


{{-- <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav> --}}
