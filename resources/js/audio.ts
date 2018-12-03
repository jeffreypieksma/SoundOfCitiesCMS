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
    event.preventDefault()

    //var form = new FormData(<HTMLFormElement>document.getElementById("audio_form"));

    var formData = new FormData();
    var audioFile = (<HTMLInputElement>document.getElementById('audio-file')).value
    var fileExtension = audioFile.replace(/^.*\./, '');
    console.log ('File Extension '+ fileExtension); 
    console.log('File '+ audioFile)

    //formData.append("audio", audioFile, audioFile.name)

    var request = new XMLHttpRequest();
    var async = true;
    request.open("POST", "/my_form_handler", async);
    if (async) {
        request.onreadystatechange = function() {
            if(request.readyState == 4 && request.status == 200) {
                var response = null;
                try {
                    response = JSON.parse(request.responseText);
                } catch (e) {
                    response = request.responseText;
                }
                console.log(response);
            }
        }
    }
    request.send(formData);
   

    // const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
    // api.post('/collection/create', {
    //     object
    // })
    // .then(res => {
    //     console.log(res)
    // })
    // .catch(error => {
    //     console.log(error)
    // })

};

// function uploadForm() {
//     var formElement = document.querySelector("audio_form");
//     var formData = new FormData(<HTMLFormElement>formElement);

//     formData.append('username', 'Chris');
//     formData.append('username', 'Bob');

//     var form = new FormData(<HTMLElement>document.getElementById("my_form"));
//     form.append("user_audio_blob", audioBlob);
//     var request = new XMLHttpRequest();
//     var async = true;
//     request.open("POST", "/my_form_handler", async);
//     if (async) {
//         request.onreadystatechange = function() {
//             if(request.readyState == 4 && request.status == 200) {
//                 var response = null;
//                 try {
//                     response = JSON.parse(request.responseText);
//                 } catch (e) {
//                     response = request.responseText;
//                 }
//                 uploadFormCallback(response);
//             }
//         }
//     }
//     request.send(form);
// }