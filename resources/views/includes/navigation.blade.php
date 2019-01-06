<nav id="nav-main">
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">{{ config('app.name', '') }}</a>
      <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <ul class="right hide-on-med-and-down">
        <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="/">Home</a></li>
        @guest
            <li class="{{ $current_route_name == 'login' ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
            <li class="{{ $current_route_name == 'register' ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
        @else
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown1">{{ Auth::user()->name }}
                <i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="{{ route('logout') }}">Logout</a></li>
                <li class="divider"></li>
                <li><a href="#!">Sub item 2</a></li>
                <li><a href="#!">Sub item 3</a></li>
            </ul>
        @endguest
      </ul>
    </div>

    <ul class="sidenav" id="mobile">
        @auth
            <li><a href=""><b>Welcome: {{Auth::user()->name }} </b></a></li>
            <li class="divider"></li>
        @endauth
    </ul>
</nav>