<nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">{{ config('app.name', '') }}</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <ul class="right hide-on-med-and-down">
        <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="/admin/users/">Users</a></li>
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

    <ul class="sidenav" id="mobile-demo">
        @auth
            <li><a href=""><b>Welcome: {{Auth::user()->name }} </b></a></li>
            <li class="divider"></li>
        @endauth
    
        
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
    </ul>
</nav>