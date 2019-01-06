<nav>
    <div class="nav-wrapper">
       <a href="#!" class="brand-logo"><i class="material-icons"></i>{{ config('app.name', '') }}</a>
      <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      
      <ul class="right hide-on-med-and-down">
        {{-- <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="{{ route('dashboard') }}">{{ __('app.dashboard') }}</a></li> --}}
        <li  class="{{ $current_route_name == '' ? 'active' : '' }}"><a href="{{ route('collections') }}">{{ __('app.collections') }}</a></li>
        
        <li>
            <a class="dropdown-trigger" href="#!" data-target="dropdown1">
            {{ (session('locale')) ? session('locale') : 'en' }}     
            <i class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="dropdown1" class="dropdown-content" style="z-index:9999999;">
            <li><a href="/locale/en" class="{{ session('locale') === "en" ? "active" : "" }}">English</a></li>
            <li><a href="/locale/nl" class="{{ session('locale') === "nl" ? "active" : "" }}">Nederlands</a></li>
        </ul>

        @guest
            <li class="{{ $current_route_name == 'login' ? 'active' : '' }}"><a href="{{ route('login') }}">{{ __('app.login') }}</a></li>
            <li class="{{ $current_route_name == 'register' ? 'active' : '' }}"><a href="{{ route('register') }}">{{ __('app.register') }}</a></li>
        @else
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown2">{{ Auth::user()->name }}
                <i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <ul id="dropdown2" class="dropdown-content">
                <li><a href="{{ route('logout') }}">{{ __('app.logout') }}</a></li>
            </ul>
        @endguest
      </ul>
    </div>

    <ul class="sidenav" id="mobile">
        @auth
            <li><a href=""><b>{{ __('app.welcome') }}: {{Auth::user()->name }} </b></a></li>
            <li class="divider"></li>
        @endauth
    
        <li><a href="{{ route('collections') }}">{{ __('collection.title') }}</a></li>

        <li>
            <a class="dropdown-trigger" href="#!" data-target="dropdown3">{{ session('locale') }}
            <i class="material-icons right">arrow_drop_down</i></a>
        </li>
        <ul id="dropdown3" class="dropdown-content" style="z-index:9999999;">
            <li><a href="/locale/en" class="{{ session('locale') === "en" ? "active" : "" }}">English</a></li>
            <li><a href="/locale/nl" class="{{ session('locale') === "nl" ? "active" : "" }}">Nederlands</a></li>
        </ul>

    </ul>
</nav>