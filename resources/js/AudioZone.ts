import axios from 'axios'


export class AudioZone {

    getCurrentCollectionId(){
        return document.getElementById('collection_info').dataset.id
    }
    
    getAudioZones(){
        let id = this.getCurrentCollectionId()

        axios.get('/audioZones/1/')
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    }

    storeAudioZone(vectorZone){
        //console.log(vectorZone)
        const zone = vectorZone;
        //const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
        axios.post('/audioZone/create', {
            zone
        })
        .then(res => {
            let data = res.data;
            let zone = new Zone (data.id, vectorZone.type, vectorZone.coords, vectorZone.center_point, vectorZone.radius);
            console.log(zone);
        })
        .catch(error => {
            console.log(error)
        })
    
    }
    
    
}