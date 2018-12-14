<nav>
    <div class="nav-wrapper">
       <a href="#!" class="brand-logo"><i class="material-icons"></i>{{ config('app.name', '') }}</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <ul class="right hide-on-med-and-down">
        <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a></li>
        {{-- <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="/admin/users/">Users</a></li> --}}
        @guest
            <li class="{{ $current_route_name == 'login' ? 'active' : '' }}"><a href="{{ route('login') }}">{{ __('app.login') }}</a></li>
            <li class="{{ $current_route_name == 'register' ? 'active' : '' }}"><a href="{{ route('register') }}">{{ __('app.register') }}</a></li>
        @else
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}
                <i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="{{ route('logout') }}">{{ __('app.logout') }}</a></li>
            </ul>
        @endguest
      </ul>
    </div>

    <ul class="sidenav" id="mobile-demo">
        @auth
            <li><a href=""><b>{{ __('app.welcome') }}: {{Auth::user()->name }} </b></a></li>
            <li class="divider"></li>
        @endauth
    
        
        <li><a href="{{ route('collections') }}">{{ __('collection.title') }}</a></li>

    </ul>
</nav>