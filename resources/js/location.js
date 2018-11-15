module.exports = {
    getLocation: function(){
        return getLocation();
    },
    showPosition: function (){
        return showPosition();
    }
}

var output = document.getElementById("output");
var btn = document.getElementById("test");


$(btn).click(function(){
    getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
        navigator.geolocation.watchPosition(setCoords);
    }else{
        //Error handling 
    }
}

function setCoords(position){
    this.coords = position; 
}

function showPosition(position) {
    // var lat = position.coords.latitude;
    // var lon = position.coords.longitude;

    output.innerHTML="Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            output.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            output.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            output.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            output.innerHTML = "An unknown error occurred."
            break;
    }
} 