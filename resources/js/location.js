module.exports = {
    getLocation: function(){
        return getLocation();
    }
}


var output = document.getElementById("output");
var btn = document.getElementById("test");

$(btn).click(function(){
    getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        console.log('working');
        navigator.geolocation.watchPosition(showPosition);
    } else { 
        showError();
    }
}

function showPosition(position) {
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