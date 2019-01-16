import axios from 'axios'

export class Location {
    
    showPosition(position) {
        // var lat = position.coords.latitude;
        // var lon = position.coords.longitude;
    
        output.innerHTML="Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
    }

    getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition);
        }else{
            this.showError(navigator.error)
        }
    }
    
    showError(error) {
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
}

window.onload = function () {  
    let location = new Location()
}
