import axios from 'axios'

export class Zone {

    collection_id: number;

    getCurrentCollectionId() {
        return this.collection_id
    }

    setCurrentCollectionId() {
        this.collection_id = parseInt(document.getElementById('collection_info').dataset.id)
    }

    storeAudioZone(audioZones) {
        audioZones.collection_id = this.getCurrentCollectionId()
    
        axios.post('/audioZones/create', {
            audioZones
        })
        .then(res => {
            let data = res.data
        })
        .catch(error => {
            console.log(error)
        })
    }

    addAudioToZone() {     
        const collection_id = this.collection_id; 
        const audio_zone_id = window.location.hash.substr(1);

        console.log('audio_zone_id '+ audio_zone_id);

        //let audio_zone_id = (<HTMLInputElement>document.getElementById('audio_zone_id')).value
        let track_id = (<HTMLInputElement>document.getElementById('audio_file')).value
        let volumeControl = (<HTMLInputElement>document.getElementById('audio_volume_control')).value
        let fadeIn = (<HTMLInputElement>document.getElementById('audio_fadeIn')).value
        let fadeOut = (<HTMLInputElement>document.getElementById('audio_fadeOut')).value

        let playonce = (<HTMLInputElement>document.getElementById('audio_playonce')).checked
        let loopable = (<HTMLInputElement>document.getElementById('audio_loopable')).checked

        const data = { audio_zone_id: audio_zone_id, track_id: track_id, volumeControl: volumeControl, fadeOut: fadeOut, fadeIn: fadeIn, playonce: playonce, loopable:loopable };

        console.log(audio_zone_id, track_id, volumeControl, playonce, loopable)

        this.addTrackToZone(data)
   
    }

    addTrackToZone(data) {

        axios.post('/audio/effects/create', {
            data
        })
        .then(res => {
            console.log(res)
        })
        .catch(error => {
            console.log(error)
        })
    }
    
}

window.onload = function () {  

    let ZoneObj = new Zone()

    const addAudioBtn: HTMLElement = document.getElementById('add-audio')

    addAudioBtn.addEventListener('click', function (event) {
        const audioPopup: HTMLElement = document.getElementById('audio-modal')
        audioPopup.classList.remove('open')
        event.preventDefault()
        console.log('audio btn')
       

        ZoneObj.addAudioToZone()

    });

    $(".layer-item").on('click', function(event){
        const audioPopup: HTMLElement = document.getElementById('audio-modal')
        audioPopup.classList.remove('close')
        audioPopup.classList.add('open')
        this.classList.add("active")
    });
    
    const cancel_modal: HTMLElement = document.getElementById('cancel-modal')
    
    cancel_modal.addEventListener('click', function (event) {
        event.preventDefault()
        const audioPopup: HTMLElement = document.getElementById('audio-modal')
        audioPopup.classList.add('close')
    });
  
}