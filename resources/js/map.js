var location = require('./location');

location.getLocation();

var mapboxAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
mapboxUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiamVmZnJleXBpZWtzbWEiLCJhIjoiY2pvZWFxZDYwMm12MDNwbzExbmJvbXM0byJ9.YTv6qq_Kjc7w3AhTwZd0Sg';



var mymap = L.map('mapid').setView([51.505, -0.09], 13);
L.tileLayer(mapboxUrl, {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    layers: [grayscale],
    id: 'mapbox.streets',
}).addTo(mymap);

var grayscale = L.tileLayer(mapboxUrl, {id: 'mapid', attribution: mapboxAttribution}),
    streets   = L.tileLayer(mapboxUrl, {id: 'mapid', attribution: mapboxAttribution});

var baseMaps = {
    "Grayscale": grayscale,
    "Streets": streets
};

L.control.layers(baseMaps).addTo(mymap);

var baseMaps = {
    "<span style='color: gray'>Grayscale</span>": grayscale,
    "Streets": streets
};