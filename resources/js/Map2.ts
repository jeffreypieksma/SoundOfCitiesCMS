import axios from 'axios'
import { Zone } from "./Zone"

declare let L: any

let map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 })

export class Map {

    private ZoneObj = new Zone()

    private vectorZones = L.featureGroup().addTo(map);

    public audioZones = []

    initMap() {
        // Set up the Open Street Map URL and attribution
        let osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'

        let osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib })

        //let map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 })

        // Initialise the FeatureGroup to store editable layers

        //let vectorZones = L.featureGroup().addTo(this.map);

        let controlLayer = L.control.layers({
            'osm': osm.addTo(map),
            'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {attribution: 'Google'})}, {
            'vector zones': this.vectorZones,  }, { position: 'topright', collapsed: false
        });
        
        controlLayer.addTo(map)

    }

    drawMapControl() {
       
        //Add controls with options to control 
        map.addControl(new L.Control.Draw({
            position: 'topleft',
            edit: {
                featureGroup: this.vectorZones,
                poly: {
                    allowIntersection: false
                }
            },
            draw: {
                polygon: {
                    allowIntersection: false, // Restricts shapes to simple polygons
                    showArea: true,
                    drawError: {
                        color: '#e1e100', // Color the shape will turn when intersects
                        message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
                    },
                    shapeOptions: {
                        color: '#97009c'
                    }
                },
                marker: false,
                circlemarker: false,
            }
        }));
    }

    getCurrentCollectionId() {
        return document.getElementById('collection_info').dataset.id
    }

    drawZones(data) {
        const audioZones = data
    
        //console.log(audioZones)
    
        for (var i=0; i < audioZones.length; i++) {
            const shape = audioZones[i].shape_type
            const radius = audioZones[i].radius
            const coords = audioZones[i].coords
            const color = audioZones[i].color
    
            switch(audioZones[i].shape_type) {
                case 'circle':
                    this.drawCircle(coords, radius, color )
                break;
                default:
                    this.drawPolygon(coords, color )
            }  
        }
    }

    drawCircle(coords, radius, color) {
        const lat = coords[0].lat
        const lng = coords[0].lng
        L.circle([lat, lng], {radius: radius} ).addTo(this.vectorZones)
    }
    
    
    drawPolygon(coords, color ) {
        console.log('draw polygon');
        //console.log(coords)
    
        let data = []
    
        for( let i = 0; i<coords.length; i++ ) {
            let lat =  coords[i].lat
            let lng =  coords[i].lng
            data.push([lat,lng])    
        }
    
        L.polygon(data, {color: 'red' }).addTo(this.vectorZones);
    }


    getAudioZones( ) {
        let id = this.getCurrentCollectionId()
    
        let list = {};
    
        let data = axios.get('/audioZones/'+id)
            .then(function (res) {
              
                this.drawZones(res.data);
            })
            .catch(function (error) {
                console.log(error)
            })
            return list;
    }
    //getAudioZones()
}

window.onload = function () {  
    let ZoneObj = new Zone()
    let MapObj = new Map();

    //Draw audioZones on map 
    MapObj.getAudioZones()

    map.on(L.Draw.Event.CREATED, function (e) { 
        //console.log(e);
    
        let type = e.layerType,
            layer = e.layer,
            coords = layer._latlngs,
            center_point = '',
            radius = '',
            color  = '',
            label = '',
            visibility = 1;
    
        if ( type=='circle') {  
    
            //getLatLng() works only for circle 
            var latLng = layer.getLatLng();  
            radius = layer.getRadius();
            coords = latLng;
    
        } else {   
    
            for (var i=0; i < coords.length; i++) {
               // console.log('deze'+ coords);
                //vectorZone.coords = coords[i];
                //coords = coords[i];
                //audioZone.coords = coords[i];
                //console.log('Coords '+ coords);
    
            }  
        }
    
        const audioZone = {
            collection_id: map.getCurrentCollectionId(),
            type : type,
            layer: '',
            coords: coords,
            radius: radius,
            center_point: center_point,
            visibility: visibility,
            label: label,
            color: color
            
        }
    
        map.audioZones.push(audioZone);
        //console.log(audioZones);
            
        // Add item to vector layer 
        map.vectorZones.addLayer(layer);
    });
    
    /*** Store all the audio zones to DB  ***/
    const saveBtn: HTMLElement = document.getElementById('saveCollection');
    
    saveBtn.addEventListener('click', function () {
        //storeAudioZone(audioZones);  
        ZoneObj.storeAudioZone( map.audioZones )
    });
}