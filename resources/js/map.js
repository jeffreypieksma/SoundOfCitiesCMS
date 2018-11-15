var location = require('./location');

var currentLocation = location.getLocation();

//mapboxUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiamVmZnJleXBpZWtzbWEiLCJhIjoiY2pvZWFxZDYwMm12MDNwbzExbmJvbXM0byJ9.YTv6qq_Kjc7w3AhTwZd0Sg';
mapboxUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

var map = L.map('mapid', { drawControl: true }).setView([53.201233, 5.799913], 13);
L.tileLayer(mapboxUrl, {
    attribution: '&copy; <a href=“https://www.openstreetmap.org/copyright“>OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);

 // create a feature group for Leaflet Draw to hook into for delete functionality
 var drawnItems = L.featureGroup();
 map.addLayer(drawnItems);

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
    console.log(e);
    var type = e.layerType,
        layer = e.layer;

    switch(type){
        case 'marker': 
            console.log('marker');
        break;
        case 'circle':
            console.log('circle');
        break;
        case 'polyline':
            console.log('polyline');
        break;
        case 'polygon':
            console.log('polygon');
        break;
        default:

        break;
    }
    // Save to DB and Map 
    map.addLayer(layer);
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