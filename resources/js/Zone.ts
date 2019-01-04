import axios from 'axios'

export class Zone {

    collection_id: number;
    audio_zone_id: number;
    audioEffectData: any;

    getCurrentCollectionId() {
        return this.collection_id
    }

    setCurrentCollectionId() {
        this.collection_id = parseInt(document.getElementById('collection_info').dataset.id)
    }

    getAudioZoneId() {
        return this.audio_zone_id
    }

    setAudioZoneId(audio_zone_id) {
        this.audio_zone_id = parseInt(audio_zone_id)
    }

    getAudioEffectData() {
        return this.audioEffectData;
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

    /**
         @toDo get selected audio file 
    **/
    addAudioToZone() {     
        const collection_id = this.collection_id
        const audio_zone_id = this.getAudioZoneId()

        console.log('Audio Zone ID: '+ audio_zone_id)

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

    getAudioEffects(id) {

        axios.get('/audio/effects/'+id)
        .then(res => {
            if(res.data) this.setFormData(res.data)
            
        })
        .catch(error => {
            console.log(error)
        })
    }

    /**
         @toDo set audio file selected 
    **/
    setFormData(data) {
        console.log(data);

        (<HTMLInputElement>document.getElementById('audio_file')).value = data.track_id;

        (<HTMLInputElement>document.getElementById('audio_volume_control')).value = data.volumeControl;
        (<HTMLInputElement>document.getElementById('audio_fadeIn')).value = data.fadeIn;
        (<HTMLInputElement>document.getElementById('audio_fadeOut')).value =  data.fadeOut;
        (<HTMLInputElement>document.getElementById('audio_playonce')).checked = data.playonce;
        (<HTMLInputElement>document.getElementById('audio_loopable')).checked = data.loopable;

    }
    
}
window.onload = function () {  


    let ZoneObj = new Zone()

    const addAudioBtn: HTMLElement = document.getElementById('add-audio')
    addAudioBtn.addEventListener('click', function (event) {
        event.preventDefault()
        
        ZoneObj.addAudioToZone()

    });

    $(".layer-item").on('click', function(event){ 
        //Get ID from data attribute
        const audio_zone_id = $(this).attr("data-id")
        ZoneObj.setAudioZoneId(audio_zone_id)

        //Get audio effect from DB 
        let data = ZoneObj.getAudioEffects(audio_zone_id)
        console.log(data)

        $( "#audio-modal" ).toggle()
       
    });
    
    const cancel_modal: HTMLElement = document.getElementById('cancel-modal')
    cancel_modal.addEventListener('click', function (event) {
        event.preventDefault()
        $( "#audio-modal" ).toggle();
    
    });
  
}