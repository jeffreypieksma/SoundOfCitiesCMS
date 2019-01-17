import axios from 'axios'

export class AudioZone {

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

    /*
        Store all audio zones to database
    */
    storeAudioZones(audioZones) {
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

    /*
        Get audio form value from HTML 
    */
    addAudioToZone() {     
        const audio_zone_id = this.getAudioZoneId()

        let selectedTrack = (<HTMLInputElement>document.querySelector('input[name="audioFile"]:checked')) !== null;
        
        if(selectedTrack) {
            let track_id = (<HTMLInputElement>document.querySelector('input[name="audioFile"]:checked')).value;
        } else {
            return false;
        }
      
        
        let volumeControl = (<HTMLInputElement>document.getElementById('audio_volume_control')).value
        let fadeIn = (<HTMLInputElement>document.getElementById('audio_fadeIn')).value
        let fadeOut = (<HTMLInputElement>document.getElementById('audio_fadeOut')).value

        let playonce = (<HTMLInputElement>document.getElementById('audio_playonce')).checked
        let loopable = (<HTMLInputElement>document.getElementById('audio_loopable')).checked

        const data = { audio_zone_id: audio_zone_id, track_id: track_id, volumeControl: volumeControl, fadeOut: fadeOut, fadeIn: fadeIn, playonce: playonce, loopable:loopable }

        this.storeAudioEffects(data)
   
    }
    /*
        Store audio effects to database
    */
    storeAudioEffects(data) {

        axios.post('/audio/effects/create', {
            data
        })
        .then(res => {
            console.log(res)
            this.toggleModal()
        })
        .catch(error => {
            console.log(error)
        })
    }
    /*
        Get audio effects from database and set html form data 
    */
    getAudioEffects(id) {

        axios.get('/audio/effects/'+id)
        .then(res => {

            if(res.data) {
                this.setFormData(res.data)
            } else {
                this.clearFormData()
            }

        })
        .catch(error => {
            console.log(error)
        })
    }

    deleteAudioZone(id) {
        axios.delete('/audioZone/delete', {
            data: {  'id' : id }
        })
        .then(res => {
            console.log(res)
        })
        .catch(error => {
            console.log(error)
        })
    }

    /*
        Set audio popup effect form data 
    */
    setFormData(data) {

        if( data.track_id ) {
            $("input[name='audioFile'][value="+ data.track_id +"]").prop('checked', true) 
        } 

        (<HTMLInputElement>document.getElementById('audio_volume_control')).value = data.volumeControl;
        (<HTMLInputElement>document.getElementById('audio_fadeIn')).value = data.fadeIn;
        (<HTMLInputElement>document.getElementById('audio_fadeOut')).value =  data.fadeOut;
        (<HTMLInputElement>document.getElementById('audio_playonce')).checked = data.playonce;
        (<HTMLInputElement>document.getElementById('audio_loopable')).checked = data.loopable;

    }

    clearFormData() {

        $("input[name='audioFile']").prop('checked', false);

        (<HTMLInputElement>document.getElementById('audio_volume_control')).value = '';
        (<HTMLInputElement>document.getElementById('audio_fadeIn')).value = '';
        (<HTMLInputElement>document.getElementById('audio_fadeOut')).value =  '';
        (<HTMLInputElement>document.getElementById('audio_playonce')).checked = false;
        (<HTMLInputElement>document.getElementById('audio_loopable')).checked = false;
    }    

    toggleModal() {
        $( "#audio-modal" ).toggle()
    }
}

window.onload = function () {  

    let ZoneObj = new AudioZone()

    const addAudioBtn: HTMLElement = document.getElementById('add-audio')
    addAudioBtn.addEventListener('click', function (event) {
        event.preventDefault()
        
        ZoneObj.addAudioToZone()

    });

    /*
        Get data attribute from HTML and toggle audio popup. 
    */
    $(".layer-item .title").on('click', function() { 
        const audio_zone_id = $(this).attr("data-id")
        ZoneObj.setAudioZoneId(audio_zone_id)

        //Get audio effect from database 
        ZoneObj.getAudioEffects(audio_zone_id)
        
        $( "#audio-modal" ).toggle()
       
    });

    /*
        Get data attribute from HTML and delete layer from DB. 
    */
    $(".layer-item .remove").on('click', function() { 
        const audio_zone_id = $(this).attr("data-id")
        ZoneObj.deleteAudioZone(audio_zone_id)
        $(this).parent().remove();
    });

    /*
        Close audio popup 
    */
    const cancel_modal: HTMLElement = document.getElementById('cancel-modal')
    cancel_modal.addEventListener('click', function (event) {
        event.preventDefault()
        $( "#audio-modal" ).toggle();
    
    });
  
}