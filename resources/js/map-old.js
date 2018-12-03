var location = require('./location');

var currentLocation = location.getLocation();

console.log(currentLocation);

//Constructor
function Zone (type, coords, center_point, radius) {
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
    this.radius = radius;
}

// Create the map
var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    
    osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    
    osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
    
    map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 }),
    
    drawnItems = L.featureGroup().addTo(map);

    L.control.layers({
        'osm': osm.addTo(map),
        'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {attribution: 'Google'})
}, {    'drawlayer': drawnItems }, { position: 'topright', collapsed: false }).addTo(map);

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
        }
    }
}));

map.on(L.Draw.Event.CREATED, function (e) { 
    var type = e.layerType,
        layer = e.layer;
        coords = layer._latlngs; 
          
    var zone = new Zone();
    zone.type = type;

    //TO DO Length checken of controleren als het een array is. 
    
    //rectangle, circle, polygon, polyline

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

    // Save to DB and Map
    drawnItems.addLayer(layer);
 });

 //Handle click on polygon
var onPolyClick = function(e){
   //console.log(e);

    drawnItems.setStyle({
        color: 'red',
        fillColor: 'blue'
    });
};

drawnItems.on('click', onPolyClick);





 //Init map 
// mapboxUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
// var map = L.map('mapid', { drawControl: true }).setView([53.201233, 5.799913], 13);
// L.tileLayer(mapboxUrl, {
//     attribution: '&copy; <a href=“https://www.openstreetmap.org/copyright“>OpenStreetMap</a> contributors',
//     maxZoom: 18,
// }).addTo(map);

//  // create a feature group for Leaflet Draw to hook into for delete functionality
//  var drawnItems = L.featureGroup().addTo(map);
//  map.addLayer(drawnItems);

// // create a new Leaflet Draw control
// var drawControl = new L.Control.Draw({
//     edit: {
//         featureGroup: drawnItems,
//         edit: true 
//     },
//     delete: {

//     },
//     draw: {
//       circle: false, // disable circles
//       marker: false, // disable polylines
//       polyline: false, // disable polylines
//       polygon: {
//         allowIntersection: false, // polygons cannot intersect thenselves
//         drawError: {
//           color: 'red', // color the shape will turn when intersects
//           message: '<strong>Oh snap!<strong> you can\'t draw that!' // message that will show when intersect
//         },
//       }
//     }
//   });

// // add our drawing controls to the map
// map.addControl(drawControl);

// map.on(L.Draw.Event.CREATED, function (e) {
//     var type = e.layerType,
//         layer = e.layer;

//     var coords = layer._latlngs;
//     console.log(coords);
        
//     var zone = new Zone();
//     zone.type = type;

//     //Length checken of controleren als het een array is. 
   
//     for(var i=0; i < coords.length; i++){
//         zone.coords = coords[i];
//     }
//     console.log(zone);  
    
//     // Save to DB and Map 
//     map.addLayer(layer);
//  });

//  map.on('draw:edited', function (e) {
//     var layers = e.layers;
//     console.log(e);
//     layers.eachLayer(function (layer) {
//         //do whatever you want; most likely save back to db
//         console.log(layer);
//     });
// });


// // when we start using creation tools disable our custom editing
// map.on('draw:createstart', function() {
   
// });


// // when we start using deletion tools, hide attributes and disable custom editing
// map.on('draw:deletestart', function() {
  
// });

// // when the map is clicked, stop editing
// map.on('click', function(e) {

// });