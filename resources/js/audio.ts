import axios from 'axios'

interface Audio {
    name: string
    url: string
    extension: string
    length: number
}

function getAudio(object: Audio){
    console.log(object.url);
}

function storeAudio(event){
    event.preventDefault()

    let object = {
        name: 'cooletrack',
        url: 'resources/ditismijnmooiepath',
        extension: 'mp3',
        length: 9
        // title: (<HTMLInputElement>document.getElementById('title')).value,
        // description: (<HTMLInputElement>document.getElementById('description')).value,
        // location: (<HTMLInputElement>document.getElementById('location')).value
    }

    getAudio(object);
}

let save_audio = document.getElementById('save-audio')

save_audio.onclick = function(event){  
    //event.preventDefault()

    var formData = new FormData()
    var audioFile = (<HTMLInputElement>document.getElementById('audio-file')).value
    var fileExtension = audioFile.replace(/^.*\./, '')
    formData.append("audio", audioFile[0])

    console.log ('File Extension '+ fileExtension)
    console.log('File '+ audioFile)
    
    const api = axios.create({baseURL: 'http://soundofcitiescms.test'});

    api.post('/audio/create', formData, {  
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(res => {
        console.log(res)
    })
    .catch(error => {
        console.log(error)
    })

};