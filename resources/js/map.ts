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

//Add controls with draw options
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
            rectangle: false,
            polygon: false,
            // polygon: {
            //     allowIntersection: false, // Restricts shapes to simple polygons
            //     showArea: true,
            //     drawError: {
            //         color: '#e1e100', // Color the shape will turn when intersects
            //         message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
            //     },
            //     shapeOptions: {
            //         color: '#553F92'
            //     }
            // },
        
        }
    }));

}
//Draw map and control layers 
drawMapControl()
drawControlLayers()

/*
    When leaflet draw event is created execute this code 
*/
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

function getAudioZones( ) {
    let id = getCurrentCollectionId()

    axios.get('/audioZones/'+id)
    .then(function (res) {
        drawZones(res.data)
    })
    .catch(function (error) {
        console.log(error)
    })
}

getAudioZones()

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

/* Store all the audio zones into the database and reload the page  */
const saveBtn: HTMLElement = document.getElementById('saveCollection');
const toggleLayersBtn: HTMLElement = document.getElementById('toggleLayers');

saveBtn.addEventListener('click', function () {    
    ZoneObj.storeAudioZones(audioZones) 
    setTimeout(reloadWindow, 1000); 

});

function reloadWindow() {
    document.location.reload(true)
}

toggleLayersBtn.addEventListener('click', function () {    
    $("body").toggleClass('layers-active')
    $("#layers").toggleClass('active')
});
