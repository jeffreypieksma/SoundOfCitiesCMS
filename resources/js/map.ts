import axios from 'axios'

declare let L: any;

//Constructor
function Zone (type, coords, center_point, radius) {
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
    this.radius = radius;
}

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
        circle: false,
    }
}));

//var layerControl = L.control.layers(null, mapOverlays, {position:'topleft'}).addTo(map);

map.on(L.Draw.Event.CREATED, function (e) { 
    let type = e.layerType
    let layer = e.layer;
    let coords = layer._latlngs; 
    let center_point = '';

    let zone = new Zone(type, coords, center_point, radius);

    //rectangle, circle, polygon, polyline
    zone.type = type;
    if(type=='circle'){  
        var latLng = layer.getLatLng();
        zone.coords = latLng;
        //console.log('center '+ latLng);

        var radius = layer.getRadius();
        zone.radius = radius;
        //console.log('Radius  '+ radius);
        
    }else{   
        for(var i=0; i < coords.length; i++){
            zone.coords = coords[i];
        }  
    }

    storeAudioZone(zone);

    console.log(zone);
    
    // Save to DB and Map
    drawnItems.addLayer(layer);
 });

 //Handle click on polygon
var onPolyClick = function(e){
   console.log(e);

    drawnItems.setStyle({
        color: 'red',
        fillColor: 'blue'
    });
};

drawnItems.on('click', onPolyClick);

function storeAudioZone(zone){

    const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
    api.post('/audioZone/create', {
        zone
    })
    .then(res => {
        console.log(res)
    })
    .catch(error => {
        console.log(error)
    })

}

function getCurrentCollection(){

}
