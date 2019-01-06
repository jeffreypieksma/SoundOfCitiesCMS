@extends('layouts.landings')

@section('head')
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css">
@endsection

@section('content')
    <section id="header">
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <div class="nav-container">
                        <a href="#!" class="brand-logo">Resonance</a>
                        <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#banner">Resonance</a></li>
                            <li><a href="#app-features">App Features</a></li>
                            <li><a href="#app-cta">App</a></li>
                            <li><a href="#soundScaper">soundScaper</a></li>
                            <li class="register-btn"><a href="/register"><span>Register</span></a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <ul class="sidenav" id="mobile">
                <li><a href="#banner">Resonance</a></li>
                <li><a href="#app-features">App Features</a></li>
                <li><a href="#app-cta">App</a></li>
                <li><a href="#soundScaper">soundScaper</a></li>
                <li class="register-btn"><a href="#register">Register</a></li>
            </ul>
        </div>
    </section>

    <section id="banner" class="">
        <div class="container">
            <div class="row">
                <div class="col m6">
                    <div class="box-left">
                        <h1 class="hero-title color-primary">Resonance</h1>
                        <div class="hero-intro" style="">
                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor <br> 
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <br>
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            </p>
                        </div>
                        <div class="hero-download-links">
                            {{-- <a href="#" class="btn btn-download app-download waves-effect waves-light" style=""><i class="fa fa-android mr-10" style="transition: none 0s ease 0s; line-height: 35px; border-width: 0px; margin: 0px 10px 0px 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 30px;"></i> <span style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 16px;">Android <strong style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 900; font-size: 20px;">Download</strong></span></a> --}}
                            <a href="#" class="btn btn-download app-download waves-effect waves-light background-secondary" style=""><i class="fa fa-apple mr-10" style="transition: none 0s ease 0s; line-height: 35px; border-width: 0px; margin: 0px 10px 0px 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 30px;"></i> <span style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 16px;">iTunes <strong style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 900; font-size: 20px;">Download</strong></span></a>
                        </div>
                    </div>
                </div>

                <div class="col m6">
                    <div class="box-right">
                        <img src=" {{ asset('images/app-banner-image.png')  }}" alt="" width="200px">
                        <img src=" {{ asset('images/app-banner-image.png')  }}" alt="" width="220px">
                    </div>
                </div>
            <div>
            <div class="content-bottom">
                <a href="#app-features" class=""><i class="material-icons icon">keyboard_arrow_down</i></a>
            </div>
        </div>
    </section>

    <section id="app-features" class="full-height center scrollspy" >
        <div class="container">
            <div class="row text-center">
                <div class="col m12">
                    {{-- <h2 class="color-primary">App Features</h2> --}}
                    <img src="{{ asset('images/logo-app.png')  }}" alt="" width="200px" height="">
                    <p class="subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col m4 s12">
                    <ul class="icons app-functions">
                        <li class="icon-box col s6">
                            <img src="{{ asset('images/navigate-function.png')  }}" alt="">
                            <span class="icon-text">Lorem ipsum dolor sit amet</span>
                        </li>
                        <li class="icon-box col s6">
                            <img src="{{ asset('images/track_function.png')  }}" alt="">
                            <span class="icon-text">Lorem ipsum dolor sit amet</span>
                        </li>
                    </ul>
                </div>  
                <div class="col m4 s12 text-center">
                    <img src=" {{ asset('images/app-banner-image.png')  }}" alt="" width="" height="400px">
                </div>
                <div class="col m4 s12">
                    <ul class="icons app-functions">
                        <li class="icon-box col s6">
                            <img src="{{ asset('images/walk-function.png')  }}" alt="">
                            <span class="icon-text">Lorem ipsum dolor sit amet</span>
                        </li>
                        <li class="icon-box col s6">
                            <img src="{{ asset('images/camera-function.png')  }}" alt="">
                            <span class="icon-text">Lorem ipsum dolor sit amet</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-bottom">
                <a href="#app-cta" class=""><i class="material-icons icon">keyboard_arrow_down</i></a>
            </div>
        </div>
        
    </section>

    <section id="app-cta" class="full-height center scrollspy">
        <div class="container">
            <div class="row text-center">
                <div class="col m12 s12">
                    <h2 class="color-white"> Lorem ipsum dolor sit amet.</h2>
                     <a href="#" class="btn btn-download app-download waves-effect waves-light background-secondary" style=""><i class="fa fa-apple mr-10" style="transition: none 0s ease 0s; line-height: 35px; border-width: 0px; margin: 0px 10px 0px 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 30px;"></i> <span style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 16px;">iTunes <strong style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 900; font-size: 20px;">Download</strong></span></a>
                </div>

            </div>
            <div class="content-bottom">
                <a href="#soundScaper" class=""><i class="material-icons icon">keyboard_arrow_down</i></a>
            </div>
        </div>
        
         

    </section>

    <section id="soundScaper" class="full-height center scrollspy">
        <div class="container">
            <div class="row text-center">
                <div class="col m12 s12">
                    <h2 class="color-white">Build Amazing Soundscapes</h2>
                    <img src="{{ asset('images/logo-resonance.png')  }}" alt="" width="300px" height="">
                    {{-- <p class="subtitle color-white">With the ultimate tool to enhance experience</p> --}}
                    
                </div>
                <div class="col m12 s12">
                    <a href="/admin" class="btn button large background-secondary">Try now!</a>
                </div>
            </div>
        </div>   
    </section>

    <footer>
        <section id="footer" class="half-height scrollspy">
            <div class="container">
                <div class="row">
                    <div class="col m3 s6">
                        <h3 class="color-white">Information</h3>
                        <ul>
                            
                            <li><img src="{{ asset('images/logo-app.png')  }}" alt="" width="200px" height=""></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col m3 s6">
                        <h3 class="color-white">Menu</h3>
                        <ul>
                            <li><a href="#app-features">App Features</a></li>
                            <li><a href="#app-cta">App</a></li>
                            <li><a href="#soundScaper">soundScaper</a></li>
                            <li class="register-btn"><a href="#register"><span>Register</span></a></li>
                        </ul>
                    </div>
                    <div class="col m3 s12">
                        <h3 class="color-white">Contact</h3>
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Lorem ipsum dolor sit amet</li>
                        </ul>
                        
                    </div>
                    <div class="col m3 s12">
                        <h3 class="color-white">Resonance SoundScape</h3>
                        <ul>
                            <li><img src="{{ asset('images/logo-resonance.png')  }}" alt="" width="200px" height=""></li>
                            <li><a href="/admin">Login</a></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="footer-bottom">
                <div class="container">
                    <div class="row text-center">
                        <div class="col s12">
                            <p>Copyright Resonance 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    
@endsection()