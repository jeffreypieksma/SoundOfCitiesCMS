var location = require('./location');

var currentLocation = location.getLocation();

console.log(currentLocation);

//Constructor
function Zone (type, coords, center_point) {
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
}

//Init map 
mapboxUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
var map = L.map('mapid', { drawControl: true }).setView([53.201233, 5.799913], 13);
L.tileLayer(mapboxUrl, {
    attribution: '&copy; <a href=“https://www.openstreetmap.org/copyright“>OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);

 // create a feature group for Leaflet Draw to hook into for delete functionality
 var drawnItems = L.featureGroup().addTo(map).on("click", zoneClick);
 map.addLayer(drawnItems);

 function zoneClick(event) {
    console.log("Clicked on marker " + event.layer);
  }

 // create a new Leaflet Draw control
var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        edit: true 
    },
    delete: {

    },
    draw: {
      circle: false, // disable circles
      marker: false, // disable polylines
      polyline: false, // disable polylines
      polygon: {
        allowIntersection: false, // polygons cannot intersect thenselves
        drawError: {
          color: 'red', // color the shape will turn when intersects
          message: '<strong>Oh snap!<strong> you can\'t draw that!' // message that will show when intersect
        },
      }
    }
  });

// add our drawing controls to the map
map.addControl(drawControl);

map.on(L.Draw.Event.CREATED, function (e) {
    var type = e.layerType,
        layer = e.layer;

    var coords = layer._latlngs;
    console.log(coords);
        
    var zone = new Zone();
    zone.type = type;

    //Length checken of controleren als het een array is. 
   
    for(var i=0; i < coords.length; i++){
        zone.coords = coords[i];
    }
    console.log(zone);  
    


    // Save to DB and Map 
    map.addLayer(layer).bindPopup("polygon lat lon: " + coords);
 });

 map.on('draw:edited', function (e) {
    var layers = e.layers;
    console.log(e);
    layers.eachLayer(function (layer) {
        //do whatever you want; most likely save back to db
        console.log(layer);
    });
});


// when we start using creation tools disable our custom editing
map.on('draw:createstart', function() {
   
});


// when we start using deletion tools, hide attributes and disable custom editing
map.on('draw:deletestart', function() {
  
});

// when the map is clicked, stop editing
map.on('click', function(e) {

});