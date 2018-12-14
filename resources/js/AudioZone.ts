import axios from 'axios'

export class AudioZone {

    type: string
    coords: any
    center_point:string
    radius: string
    leafletObj: any

    //Constructor for Leaflet zone creator 
    constructor (type: string, coords: any , center_point: string, radius: string, leafletObj: any) {
        this.type = type
        this.coords = coords
        this.center_point = center_point
        this.radius = radius
        this.leafletObj = ''
    }

    addNewAudioZone(){

    }

    getCurrentCollectionId(){
        return document.getElementById('collection_info').dataset.id
    }
    
    getAudioZones(){
        let id = this.getCurrentCollectionId()

        axios.get('/audioZones/'+id)
        .then(function (res) {
            // handle success
            console.log(res.data);
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
        let zone = vectorZone;
        let id = this.getCurrentCollectionId()
        zone.collection_id = id;
    
        //const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
        axios.post('/audioZone/create', {
            zone
        })
        .then(res => {
            let data = res.data;
        })
        .catch(error => {
            console.log(error)
        })
    }
    
    
}