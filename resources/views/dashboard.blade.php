@extends('layouts.admin')

@section('head')

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>

    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js "></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js"
    integrity="sha512-YZ6b5bXRVwipfqul5krehD9qlbJzc6KOGXYsDjU9HHXW2gK57xmWl2gU6nAegiErAqFXhygKIsWPKbjLPXVb2g=="
    crossorigin=""></script>

    <style>
        #mapid { height: calc(100vh - 64px); }
    </style>

@endsection

@section('content')

    <div class="container-fluid">
        <div id="output" style="">Output: </div><button id="test" class="btn button">Show position</div>
        <!-- Modal Trigger -->
        <button data-target="modal1" class="btn modal-trigger">Modal</button>
        <div id="mapid"></div>

         <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Create a collection</a>

         
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            
            <div class="modal-content">
                <h4>{{ __('app.collection_title') }}</h4>
                <form method="POST" action="">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="title" type="text" name="title" class="validate">
                            <label for="title">{{ __('collection.title') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="location" type="text" name="location" class="validate">
                            <label for="location">{{ __('collection.location') }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="description" type="text" name="description" class="validate">
                            <label for="description">{{ __('collection.description') }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">                         
                            <button class="btn waves-effect waves-light" type="submit" id="save-collection" name="action">{{ __('app.save') }}
                                <i class="material-icons right">send</i>
                            </button>
        
                        </div>
                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">{{ __('app.cancel') }}</a>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>

@endsection

@section('scripts')



@endsection