import axios from 'axios'

export class Location {

    location: string;

    showPosition(position) {
        let location = (<HTMLInputElement>document.getElementById('location'))
        location.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;
      }

    getLocationFromBrowser() {
        let location = (<HTMLInputElement>document.getElementById('location'))
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.showPosition);
        } else { 
            location.innerHTML = "Geolocation is not supported by this browser.";
        }
      }
}

let location = new Location()

location.getLocationFromBrowser()