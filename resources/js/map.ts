import axios from 'axios'

declare let L: any;

//Constructor
function Zone (id, type, coords, center_point, radius) {
    this.id = 1234;
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
        //circle: false,
    }
}));

//var layerControl = L.control.layers(null, mapOverlays, {position:'topleft'}).addTo(map);

map.on(L.Draw.Event.CREATED, function (e) { 
    let type = e.layerType
    let layer = e.layer;
    let coords = layer._latlngs; 
    let center_point = '';
    let id = null;

    let zone = new Zone(id, type, coords, center_point, radius);

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

/* Unit testing

    1st: Check if all zones are stored properly and the amount is right. 
        Store data - return the ids - count ids - compare with amount of objects. 
    2nd test: Check if the amount of coordinates are right.  
    3rd: test: Check if coordinates are stored right. 
    4th: test: Draw items on map. 
    5th: test: Delete a zone  
*/

class ZoneCreator {
    drawZone (coords : any) : String {
        return ""
    }
}

function assertTrue (isSuccess : Boolean, message: String) {
    if (!isSuccess) {
        console.error ("Test niet geslaagd: " + message);
    }
}

let zoneCreator = new ZoneCreator ();

let coords = [
    [
        lat =>	'53.21061991910329',
        lng	=> '5.702758220639979'
    ],
    [
        lat =>	'53.21051704917011',
        lng	=> '5.733996253312515'
    ],
    [
        lat =>	'53.20188619560709',
        lng	=> '5.731593310342751'
    ]
]
let circleCoords = [lat=> '	53.21061991910329', lng => '5.702758220639979']

let circleZone = new Zone(1, 'circle', circleCoords, '53.21061991910329', 302323)
//storeAudioZone(circleZone)

let polygonZone = new Zone(2, 'circle', coords, '53.21061991910329', '')
//storeAudioZone(polygonZone)

let squareZone = new Zone(3, 'circle', coords, '53.21061991910329', '')
//storeAudioZone(squareZone)

//assertTrue must be true 
assertTrue (zoneCreator.drawZone (circleZone) === "", "Should handle...")
assertTrue (zoneCreator.drawZone (polygonZone) === "", "Should handle...")
assertTrue (zoneCreator.drawZone (squareZone) === "", "Should handle...")

console.log ("All tests executed");

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
