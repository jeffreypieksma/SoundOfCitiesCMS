@extends('layouts.admin')

@section('head')

   <link rel="stylesheet" href="{{ asset('css/leaflet2.css') }}"/>
   <script src="{{ asset('js/leaflet2.js') }}"></script>

    <script src="{{ asset('js/src/Leaflet.draw.js') }}"></script>
    <script src="{{ asset('js/src/Leaflet.Draw.Event.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('js/src/leaflet.draw.css') }}"/>

    <script src="{{ asset('js/src/Toolbar.js') }}"></script>
    <script src="{{ asset('js/src/Tooltip.js') }}"></script>

    <script src="{{ asset('js/src/draw/DrawToolbar.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Feature.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.SimpleShape.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Polyline.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Marker.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Circle.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.CircleMarker.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Polygon.js') }}"></script>
    <script src="{{ asset('js/src/draw/handler/Draw.Rectangle.js') }}"></script>
    <script src="{{ asset('js/src/edit/EditToolbar.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/EditToolbar.Edit.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/EditToolbar.Delete.js') }}"></script>
    <script src="{{ asset('js/src/Control.Draw.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.Poly.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.SimpleShape.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.Rectangle.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.Marker.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.CircleMarker.js') }}"></script>
    <script src="{{ asset('js/src/edit/handler/Edit.Circle.js') }}"></script> 
    <script src="{{ asset('js/src/ext/GeometryUtil.js') }}"></script>
    <script src="{{ asset('js/src/ext/LatLngUtil.js') }}"></script>
    <script src="{{ asset('js/src/ext/LineUtil.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/Polygon.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/Polyline.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/TouchEvents.js') }}"></script> 

@endsection

@section('content')
    <section id="dashboard">
        <div id="hidden" style="display:none">
            <div id="collection_info" data-id="{{ $collection->id }}" data-title="{{ $collection->title }}" data-created="{{ $collection->created_at }}"></div>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="toggleNavigation">
            <a class="btn-floating  waves-effect waves-light background-accent">
                <div class="ui-layers-icon" ></div>
                {{-- <i class="material-icons">settings</i> --}}     
            </a>         
        </div>

        <div class="container-fluid">
            {{-- Init the map  --}}
            <div id="mapid" class="animated fadeIn faster"></div>

            <a class="btn-floating btn-large waves-effect waves-light background-accent" id="saveCollection">
                <i class="material-icons">save</i>
            </a>
            
        </div>

        <div id="audioZone-popup">
            @include('modals.audio')
        </div>

        <div id="layers" class="animated fadeInRight fast active box-shadow-inset">
            <ul class="layer">
                <h3 class="color-primary text-center">{{ __('app.layers') }}</h3>
                @foreach($audioZones as $audioZone)
                    <a href="#{{ $audioZone->id }}" data-id="{{ $audioZone->id }}" class="layer-item">
                        <li>
                            <span class="title">{{ __('app.layer') }} {{ $audioZone->id }}</span>
                            <span class="remove tooltip">
                                <i class="material-icons color-black remove-layer">remove_circle</i>
                                 <span class="tooltiptext">{{ __('app.tooltip_remove_layer') }}</span>
                            </span>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>  

    </section>

@endsection

@section('scripts')

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/AudioZone.js') }}"></script>
    <script src="{{ asset('js/tests.js') }}"></script>

@endsection