import axios from 'axios'
import { AudioZone } from "./AudioZone.ts"
let audioZone = new AudioZone()

declare let L: any

//Constructor for Leaflet zone creator 
function VectorZone (type, coords, center_point, radius) {
    this.type = type
    this.coords = coords
    this.center_point = center_point
    this.radius = radius
}

//Constructor for all the full zones 
function Zone (id, type, coords, center_point, radius) {
    this.id =  id
    this.type = type
    this.coords = coords
    this.center_point = center_point
    this.radius = radius
}

function getCurrentCollectionId(){
    return document.getElementById('collection_info').dataset.id
}

audioZone.getAudioZones();

// Create the map
let osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
    map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 }),
  
    drawnItems = L.featureGroup().addTo(map);

    L.control.layers({
        'osm': osm.addTo(map),
        'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {attribution: 'Google'})
    },
    {    
        'drawlayer': drawnItems 
    }, 
    { 
        position: 'topright', 
        collapsed: false 
    }).addTo(map);


map.addControl(new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        poly: {
            allowIntersection: false
        }
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        },
        marker: false,
        circlemarker: false,
        //circle: false,
    }
}));

//var layerControl = L.control.layers(null, mapOverlays, {position:'topleft'}).addTo(map);
//http://jsfiddle.net/guspersson/393ehmsq/
map.on(L.Draw.Event.CREATED, function (e) { 
    //console.log(e);
    let type = e.layerType
    let layer = e.layer;
    let coords = layer._latlngs; 
    let center_point = '';

    let vectorZone = new VectorZone (type, coords, center_point, radius);

    //rectangle, circle, polygon, polyline
    vectorZone.type = type;
    if(type=='circle'){  
        var latLng = layer.getLatLng();
        vectorZone.coords = latLng;
        //console.log('center '+ latLng);
        
        var radius = layer.getRadius();
        vectorZone.radius = radius;
        //console.log('Radius  '+ radius);
        
    }else{   
        for(var i=0; i < coords.length; i++){
            vectorZone.coords = coords[i];
        }  
    }

   console.log( audioZone.storeAudioZone(vectorZone) );
   
    // Save to DB and Map
    drawnItems.addLayer(layer);
});

 function getAllZoneObjects(){

}




 //Handle click on polygon
 var onPolyClick = function(e){
    console.log(e);
 
     drawnItems.setStyle({
         color: 'red',
         fillColor: 'blue'
     });
 };
 
 drawnItems.on('click', onPolyClick);