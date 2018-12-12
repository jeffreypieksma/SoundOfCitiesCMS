@extends('layouts.admin')

@section('head')

   <link rel="stylesheet" href="{{ asset('css/leaflet2.css') }}"/>
   <script src="{{ asset('js/leaflet2.js') }}"></script>

    <script src="{{ asset('js/src/Leaflet.draw.js') }}"></script>
    <script src="{{ asset('js/src/Leaflet.Draw.Event.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset('js/src/leaflet.draw.css') }}"/>

    <script src="{{ asset('js/src/Toolbar.js') }}"></script>
    <script src="{{ asset('js/src/Tooltip.js') }}"></script>

    <script src="{{ asset('js/src/ext/GeometryUtil.js') }}"></script>
    <script src="{{ asset('js/src/ext/LatLngUtil.js') }}"></script>
    <script src="{{ asset('js/src/ext/LineUtil.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/Polygon.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/Polyline.Intersect.js') }}"></script>
    <script src="{{ asset('js/src/ext/TouchEvents.js') }}"></script>

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

    {{ csrf_field() }}

@endsection

@section('content')
    <div id="hidden" style="display:none">
         <div id="collection_info" data-id="{{ $collection->id }}" data-title="{{ $collection->title }}" data-created="{{ $collection->created_at }}"></div>
    </div>

    <div id="testData">
        @foreach($audioZones as $audioZone)
            {{$audioZone}}
            {{ $audioZone->zoneCoordinates }}

        @endforeach
    </div>

    <div class="container-fluid">
      
        <div id="mapid"></div>
        
    </div>


@endsection

@section('scripts')

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/audioZone.js') }}"></script>
    <script src="{{ asset('js/tests.js') }}"></script>
@endsection