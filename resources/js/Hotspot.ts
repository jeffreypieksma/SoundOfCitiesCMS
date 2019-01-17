import axios from 'axios'

export class Hotspot {

    collection_id: number;
    audio_zone_id: number;
    data: any;

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
        return this.data;
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
        //const collection_id = this.collection_id
        const audio_zone_id = this.getAudioZoneId()

        let track_id = (<HTMLInputElement>document.querySelector('input[name="audioFile"]:checked')).value;

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
            this.showSuccesMessage(res.data)
        })
        .catch(error => {
            console.log(error)
            this.showSuccesMessage(error)
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

    showSuccesMessage(message) {
        //console.log('Succes ' + message);
        (<HTMLInputElement>document.getElementById('succesMessage')).innerHTML  = message;
    }

    showErrorMessage(message) {

        //console.log('Error '+ message);

        (<HTMLInputElement>document.getElementById('errorMessage')).innerHTML  = message;
    }
    
}
window.onload = function () {  

    /*
        Get data attribute from HTML and toggle modal popup. 
    */
    $(".layer-item .hotspot").on('click', function() { 
        const audio_zone_id = $(this).attr("data-id")
        $( "#hotspot-modal" ).toggle()
       
    });

   

    /*
        Modal popup
    */
    const cancel_modal: HTMLElement = document.getElementById('cancel-modal')
    cancel_modal.addEventListener('click', function (event) {
        event.preventDefault()
        $( "#hotspot-modal" ).toggle();
    
    });
  
}