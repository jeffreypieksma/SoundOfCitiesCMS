@extends('layouts.admin')

@section('head')
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/> --}}
   <link rel="stylesheet" href="{{'css/leaflet2.css'}}"/>
   <script src="{{'js/leaflet2.js'}}"></script>

   {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/> --}}

    {{-- <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script> --}}
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script> --}}

    <style>
        #mapid{  height: calc(100vh - 64px); width:100%;}
    </style>

    {{-- Leaflet extension  --}}

    <script src="{{'js/src/Leaflet.draw.js'}}"></script>
    <script src="{{'js/src/Leaflet.Draw.Event.js'}}"></script>
    <link rel="stylesheet" href="{{'js/src/leaflet.draw.css'}}"/>

    <script src="{{'js/src/Toolbar.js'}}"></script>
    <script src="{{'js/src/Tooltip.js'}}"></script>

    <script src="{{'js/src/ext/GeometryUtil.js'}}"></script>
    <script src="{{'js/src/ext/LatLngUtil.js'}}"></script>
    <script src="{{'js/src/ext/LineUtil.Intersect.js'}}"></script>
    <script src="{{'js/src/ext/Polygon.Intersect.js'}}"></script>
    <script src="{{'js/src/ext/Polyline.Intersect.js'}}"></script>
    <script src="{{'js/src/ext/TouchEvents.js'}}"></script>

    <script src="{{'js/src/draw/DrawToolbar.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Feature.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.SimpleShape.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Polyline.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Marker.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Circle.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.CircleMarker.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Polygon.js'}}"></script>
    <script src="{{'js/src/draw/handler/Draw.Rectangle.js'}}"></script>
    <script src="{{'js/src/edit/EditToolbar.js'}}"></script>
    <script src="{{'js/src/edit/handler/EditToolbar.Edit.js'}}"></script>
    <script src="{{'js/src/edit/handler/EditToolbar.Delete.js'}}"></script>
    <script src="{{'js/src/Control.Draw.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.Poly.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.SimpleShape.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.Rectangle.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.Marker.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.CircleMarker.js'}}"></script>
    <script src="{{'js/src/edit/handler/Edit.Circle.js'}}"></script>

@endsection

@section('content')

    <div class="container-fluid">
        <div id="toolbar-wrapper" style="display:none;">
            <div id="output" style="">Output: </div><button id="test" class="btn button">Show position</button>
            <!-- Modal Trigger -->
            <button data-target="modal1" class="btn modal-trigger">Modal</button>
        </div>
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
                            <button class="btn waves-effect waves-light" type="submit" onclick="storeCollection();" id="save-collection" name="action">{{ __('app.save') }}
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

    

@endsection

@section('scripts')

<script src="{{ asset('js/admin.js') }}"></script>

@endsection