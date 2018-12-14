import axios from 'axios'
import { AudioZone } from "./AudioZone"

declare let L: any

let audioZones = [

]


//Constructor for Leaflet zone creator 
// function AudioZone (type, coords, center_point, radius) {
//     this.type = type
//     this.coords = coords
//     this.center_point = center_point
//     this.radius = radius
// }

// Set up the Open Street Map URL and attribution
let osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'

let osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib })

let map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 })
    
// Initialise the FeatureGroup to store editable layers
let vectorZones = L.featureGroup().addTo(map);

let controlLayer = L.control.layers({
    'osm': osm.addTo(map),
    'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {attribution: 'Google'})}, {
    'vector zones': vectorZones,  }, { position: 'topright', collapsed: false
});

controlLayer.addTo(map)

//Add controls with options to control 
map.addControl(new L.Control.Draw({
    position: 'topleft',
    edit: {
        featureGroup: vectorZones,
        poly: {
            allowIntersection: false
        }
    },
    draw: {
        polygon: {
            allowIntersection: false, // Restricts shapes to simple polygons
            showArea: true,
            drawError: {
                color: '#e1e100', // Color the shape will turn when intersects
                message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
              },
              shapeOptions: {
                color: '#97009c'
              }
        },
        marker: false,
        circlemarker: false,
    }
}));

map.on(L.Draw.Event.CREATED, function (e) { 
    //console.log(e);

    let type = e.layerType,
        layer = e.layer,
        coords = layer._latlngs,
        center_point = '',
        radius = '',
        color  = 'red';

    if ( type=='circle') {  

        //getLatLng() works only for circle 
        var latLng = layer.getLatLng();  
        radius = layer.getRadius();
        coords = latLng;

    } else {   

        for (var i=0; i < coords.length; i++) {
           // console.log('deze'+ coords);
            //vectorZone.coords = coords[i];
            //coords = coords[i];
            //audioZone.coords = coords[i];
            //console.log('Coords '+ coords);

        }  
    }


    const audioZone = {
        collection_id: getCurrentCollectionId(),
        type : type,
        layer: '',
        coords: coords,
        radius: radius,
        center_point: center_point,
        visibility: 1,
        label: 'Naam van obj',
        color:color,
        
    }

    audioZones.push(audioZone);
    console.log(audioZones);
        
    // Add item to vector layer 
    vectorZones.addLayer(layer);
});

/*** Store all the audio zones to DB  ***/
const saveButton: HTMLElement = document.getElementById('saveCollection');

saveButton.addEventListener('click', function () {
    //AudioZone.storeAudioZone(audioZones);
    storeAudioZone(audioZones);
    
});

function storeAudioZone(audioZones){
    let id = getCurrentCollectionId()
    audioZones.collection_id = id;

    //const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
    axios.post('/audioZones/create', {
        audioZones
    })
    .then(res => {
        let data = res.data;
    })
    .catch(error => {
        console.log(error)
    })
}

function getAudioZones( ) {
    let id = getCurrentCollectionId()

    axios.get('/audioZones/'+id)
    .then(function (res) {
        // handle success
        console.log(res.data)
    })
    .catch(function (error) {
        // handle error
        console.log(error)
    })
    .then(function () {
        // always executed
    });
}
getAudioZones()

//Loop trough all audio zones 
function loopAudioZones() {
    for (var i=0; i < audioZones.length; i++) {
        console.log(audioZones[i].type)
    }
}

function deleteAudioZone(index ) {
    delete audioZones[index]
}

function drawRectangle(){

    L.rectangle([
        ['53.20554188925172','5.776233673095703'],
        ['53.209751772083315', '5.776233673095703'],
        ['53.209751772083315', '5.790996551513673'],
        ['53.20554188925172','5.790996551513673']

    ]).addTo(vectorZones)

}

drawRectangle()

function drawCircle(){
    L.circle(['53.204823087432416', '5.7575225830078125'], {radius: 161.0649398300031} ).addTo(vectorZones);
}

drawCircle()

function drawPolygon(){
    var latlngs =[
        ['53.19577614208885','5.780868530273438'],
        ['53.19577614208885','5.796661376953126'],
        [' 53.192900207296766','5.787391662597657']
    ];

    L.polygon(latlngs, {color:'red'}).addTo(vectorZones);

    //L.polygon().addTo(drawnItems)

}
drawPolygon();

//Handle click on polygon
var onPolyClick = function(e){
    console.log(e);
 
    // vectorZones.setStyle({
    //      color: 'red',
    //      fillColor: 'blue'
    //  });
 };
 
 vectorZones.on('click', onPolyClick);

 function getCurrentCollectionId(){
    return document.getElementById('collection_info').dataset.id
}

// console.log('latLngs '+ layer.getLatLng())
// console.log('Coords '+ coords);

//Set custom properties to layer 
// let feature = layer.feature = layer.feature || {}; // Intialize layer.feature
// feature.type = feature.type || "Feature"; // Intialize feature.type
// let props = feature.properties = feature.properties || {}; // Intialize feature.properties
// props.id = 99;