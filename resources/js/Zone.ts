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
        let audio_zone_id = (<HTMLInputElement>document.getElementById('audio_zone_id')).value

        //let title = (<HTMLInputElement>document.getElementById('audio_title')).value
        let audioFile = (<HTMLInputElement>document.getElementById('audio_file')).value
        let volumeControl = (<HTMLInputElement>document.getElementById('audio_volume_control')).value
        let fadeIn = (<HTMLInputElement>document.getElementById('audio_fadeIn')).value
        let fadeOut = (<HTMLInputElement>document.getElementById('audio_fadeOut')).value

        let playonce = (<HTMLInputElement>document.getElementById('audio_playonce')).checked
        let loopable = (<HTMLInputElement>document.getElementById('audio_loopable')).checked

        const data = { audio_zone_id: audio_zone_id, audioFile: audioFile, volumeControl: volumeControl, fadeOut: fadeOut, fadeIn: fadeIn, playonce: playonce, loopable:loopable };

        console.log(audio_zone_id, audioFile, volumeControl, playonce, loopable)

        this.addTrackToZone(data)
   
    }

    addTrackToZone(data) {

        axios.post('/audioZones/track/create', {
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
        console.log('audio btn')
        event.preventDefault()

        ZoneObj.addAudioToZone()

    });
  
}


$(".modal-trigger").on('click', function(){
    console.log('yup')
});

function test(){
alert('haai')
}