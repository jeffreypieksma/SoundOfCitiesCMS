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

    addAudioFileToZone() {     
        console.log('working')
        const collection_id = this.collection_id;
        let id = (<HTMLInputElement>document.getElementById('audio_zone_id')).value

        let title = (<HTMLInputElement>document.getElementById('audio_title')).value
        let audioFile = (<HTMLInputElement>document.getElementById('audio_file')).value
        let volumeControl = (<HTMLInputElement>document.getElementById('audio_volume_control')).value

        let playonce = (<HTMLInputElement>document.getElementById('audio_playonce')).checked
        let loopable = (<HTMLInputElement>document.getElementById('audio_loopable')).checked

        let data = [
           id, title, audioFile, volumeControl, playonce, loopable
        ]

        console.log(id, title, audioFile, volumeControl, playonce, loopable)

        this.addTrackToZone(data)
   
    }

    addTrackToZone(data) {

        axios.post('/audioZones/create', {
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

let ZoneObj = new Zone()

const addAudioBtn: HTMLElement = document.getElementById('add-audio')

addAudioBtn.addEventListener('click', function (event) {
    event.preventDefault()

    ZoneObj.addAudioFileToZone()

});
