import axios from 'axios'
import { AudioZone } from "./AudioZone";

let ZoneObj = new AudioZone();

declare let L: any

let audioZones = []

// Set up the Open Street Map URL and attribution
let osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'

let osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'

let osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib })

let map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 })
    
// Initialise the FeatureGroup to store editable layers
let vectorZones = L.featureGroup().addTo(map);

function drawControlLayers() {
    let controlLayer = L.control.layers({
        'osm': osm.addTo(map),
        'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {attribution: 'Google'})}, {
        'vector zones': vectorZones,  }, { position: 'topright', collapsed: false
    });
    controlLayer.addTo(map)
}

drawControlLayers()

//Add controls with options to control 
function drawMapControl() {
    
    map.addControl(new L.Control.Draw({
        position: 'topleft',
        edit: {
            featureGroup: vectorZones,
            poly: {
                allowIntersection: false
            }
        },
        draw: {
            polyline: false,
            marker: false,
            circlemarker: false,
            polygon: {
                allowIntersection: false, // Restricts shapes to simple polygons
                showArea: true,
                drawError: {
                    color: '#e1e100', // Color the shape will turn when intersects
                    message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
                },
                shapeOptions: {
                    color: '#553F92'
                }
            },
        
        }
    }));

}

drawMapControl()

map.on(L.Draw.Event.CREATED, function (e) { 

    let type = e.layerType,
        layer = e.layer,
        coords = layer._latlngs,
        center_point = '',
        radius = '',
        color  = '',
        label = '',
        visibility = 1,
        latLng = '';

    if(type == 'circle') {

        latLng = e.latlng || e.layer.getLatLng();
        radius = layer.getRadius();

    } else {    
        latLng = e.latlngs || e.layer.getLatLngs();
    }

    //let latLng = layer.getLatLng();  
    
    coords = latLng;

    const audioZone = {
        collection_id: getCurrentCollectionId(),
        type : type,
        layer: '',
        coords: coords,
        radius: radius,
        center_point: center_point,
        visibility: visibility,
        label: label,
        color: color   
    }

    audioZones.push(audioZone);
        
    // Add item to vector layer 
    vectorZones.addLayer(layer);
});


function getCurrentCollectionId() {
    return document.getElementById('collection_info').dataset.id
}

function drawCircle(coords, radius, color) {
    const lat = coords[0].lat
    const lng = coords[0].lng
    L.circle([lat, lng], {radius: radius} ).addTo(vectorZones)
}


function drawPolygon(coords, color ) {
    let data = []

    for( let i = 0; i<coords.length; i++ ) {
        let lat =  coords[i].lat
        let lng =  coords[i].lng
        data.push([lat,lng])    
    }

    L.polygon(data, {color: 'red' }).addTo(vectorZones);
}

function getAudioZones( ) {
    let id = getCurrentCollectionId()

    let list = {};

    let data = axios.get('/audioZones/'+id)
        .then(function (res) {
            drawZones(res.data);
        })
        .catch(function (error) {
            console.log(error)
        })

        return list;
}
getAudioZones()

function drawZones(data) {

    const audioZones = data

    for (let i=0; i < audioZones.length; i++) {
        const shape = audioZones[i].shape_type
        const radius = audioZones[i].radius
        const coords = audioZones[i].coords
        const color = audioZones[i].color

        switch(audioZones[i].shape_type) {
            case 'circle':
                drawCircle(coords, radius, color )
            break;
            default:
                drawPolygon(coords, color )
        } 
    }
}

/*** Store all the audio zones into the database and reload the page  ***/
const saveBtn: HTMLElement = document.getElementById('saveCollection');

saveBtn.addEventListener('click', function () {    
    ZoneObj.storeAudioZones(audioZones)  
    document.location.reload(true)
    
});



///////////////////////////////////////////////////////////////////////////////////////////////////////

// create popup contents
let customPopup = "<h6>Add Audio </h6>";
    
// specify popup options 
let customOptions = {'maxWidth': '600', 'className' : 'custom popup audioPopup'}

vectorZones.on("click", function (e) {
    let layer = e.layer 
    let type = e.layerType
    console.log(e)
    layer.bindPopup(customPopup,customOptions).openPopup();
});

// //Loop trough all audio zones 
// function loopAudioZones() {
//     for (var i=0; i < audioZones.length; i++) {
//         console.log(audioZones[i].type)
//     }
// }

// function deleteAudioZone(index ) {
//     delete audioZones[index]
// }

// //Handle click on polygon
// var onPolyClick = function(e) {
    
//     console.log('Polygon clicked '+ e);
 
// };
 
// vectorZones.on('click', onPolyClick);