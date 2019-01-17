import axios from 'axios'
import { AudioZone } from "./AudioZone"

let audioZone = new AudioZone()

export class Hotspot {

    data: any;

    /*
        Get hotspot form value from HTML 
    */
   addHotspotToAudioZone() {     
        
        const audio_zone_id = audioZone.getAudioZoneId()

        let title = (<HTMLInputElement>document.getElementById('hotspot_title')).value
        let history = (<HTMLInputElement>document.getElementById('hotspot_history')).value
        let music = (<HTMLInputElement>document.getElementById('hotspot_music')).value
        let activities = (<HTMLInputElement>document.getElementById('hotspot_activities')).value

        const data = { audio_zone_id: audio_zone_id, title: title, history: history, music: music, activities: activities}

        this.storeHotspot(data)
   
    }

    storeHotspot(data) {

    }

    getHotspot(id) {

    }

    deleteHotspot(id) {

    }

    setFormData(data) {

    }

    clearFormData() {

    }  

}

window.onload = function () {  
    let hotspot = new Hotspot()

    const addHotspotBtn: HTMLElement = document.getElementById('add-hotspot')
    addHotspotBtn.addEventListener('click', function (event) {
        event.preventDefault()

        hotspot.addHotspotToAudioZone()

    });

    /*
        Get data attribute from HTML and toggle modal popup. 
    */
    $(".layer-item .hotspot").on('click', function() { 
        const audio_zone_id = $(this).attr("data-id")

        audioZone.setAudioZoneId(audio_zone_id)

        //hotspot.getHotspotData(audio_zone_id)

        $( "#hotspot-modal" ).toggle()
    
    });

    /*
        Modal popup close
    */
    const cancel_modal: HTMLElement = document.getElementById('cancel-modal')
    cancel_modal.addEventListener('click', function (event) {
        event.preventDefault()
        $( "#hotspot-modal" ).toggle();
    
    });
  
}