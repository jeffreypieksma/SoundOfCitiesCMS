@extends('layouts.landings')

@section('head')
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.css">
@endsection

@section('content')
    <section id="banner" class="full-height">
        <div class="container-fluid">
            <div class="row">
                <div class="col m9 full-height">
                    <h1 class="hero-title">SoundOfCities</h1>
                    <div class="hero-intro" style="">
                        <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor <br> 
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud <br>
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        </p>
                    </div>
                    <div class="hero-download-links">
                        <a href="#" class="btn btn-download app-download waves-effect waves-light" style=""><i class="fa fa-android mr-10" style="transition: none 0s ease 0s; line-height: 35px; border-width: 0px; margin: 0px 10px 0px 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 30px;"></i> <span style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 16px;">Android <strong style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 900; font-size: 20px;">Download</strong></span></a>
                        <a href="#" class="btn btn-download app-download waves-effect waves-light" style=""><i class="fa fa-apple mr-10" style="transition: none 0s ease 0s; line-height: 35px; border-width: 0px; margin: 0px 10px 0px 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 30px;"></i> <span style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 400; font-size: 16px;">iTunes <strong style="transition: none 0s ease 0s; line-height: 22px; border-width: 0px; margin: 0px; padding: 0px; letter-spacing: 0px; font-weight: 900; font-size: 20px;">Download</strong></span></a>
                    </div>
                </div>

                <div class="col m3">
                    <img src=" {{ asset('images/1.png')  }}" alt="">
                    <img src=" {{ asset('images/2.png')  }}" alt="">
                </div>
            <div>
        </div>
    </div>
    <section id="">
        <h1>testing language </h1>

         @include('includes.languageSwitcher')

    </section>

    <style>
        .full-height{
            height:100vh;
        }
        h1{
            margin:0px;
        }
        .flex{
            display:flex;
        }

        .vertical-center{      
            justify-content: center;
        }
        
        .horizontal-center{
            align-items: center;
        }


        #banner{
            
        background: #16a085; /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #16a085, #f4d03f); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #16a085, #f4d03f); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        html,body{
            margin:0px;
            padding:0px;
        }
    </style>
@endsection()