/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(39);


/***/ }),

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

__webpack_require__(40);

__webpack_require__(42);

__webpack_require__(43);

$(document).ready(function () {
  $('.modal').modal();
});

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function () {

  $('.sidenav').sidenav();
  $(".dropdown-trigger").dropdown();
  // $('#dataTable').DataTable({
  // //paging: false
  // });
});

/***/ }),

/***/ 40:
/***/ (function(module, exports) {

// var location = require('./location');
// var currentLocation = location.getLocation();
// console.log(currentLocation);
//Constructor
function Zone(type, coords, center_point, radius) {
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
    this.radius = radius;
}
// Create the map
var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors', osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }), map = new L.Map('mapid', { center: new L.LatLng(53.201233, 5.799913), zoom: 13 }), drawnItems = L.featureGroup().addTo(map);
L.control.layers({
    'osm': osm.addTo(map),
    'google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', { attribution: 'Google' })
}, { 'drawlayer': drawnItems }, { position: 'topright', collapsed: false }).addTo(map);
map.addControl(new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
        poly: {
            allowIntersection: false
        }
    },
    draw: {
        polygon: {
            allowIntersection: false,
            showArea: true
        }
    }
}));
map.on(L.Draw.Event.CREATED, function (e) {
    var type = e.layerType;
    var layer = e.layer;
    var coords = layer._latlngs;
    var center_point = '';
    var zone = new Zone(type, coords, center_point, radius);
    //rectangle, circle, polygon, polyline
    zone.type = type;
    if (type == 'circle') {
        var latLng = layer.getLatLng();
        zone.coords = latLng;
        //console.log('center '+ latLng);
        var radius = layer.getRadius();
        zone.radius = radius;
        //console.log('Radius  '+ radius);
    }
    else {
        for (var i = 0; i < coords.length; i++) {
            zone.coords = coords[i];
        }
    }
    console.log(zone);
    // Save to DB and Map
    drawnItems.addLayer(layer);
});
//Handle click on polygon
var onPolyClick = function (e) {
    //console.log(e);
    drawnItems.setStyle({
        color: 'red',
        fillColor: 'blue'
    });
};
drawnItems.on('click', onPolyClick);
//Init map 
// mapboxUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
// var map = L.map('mapid', { drawControl: true }).setView([53.201233, 5.799913], 13);
// L.tileLayer(mapboxUrl, {
//     attribution: '&copy; <a href=“https://www.openstreetmap.org/copyright“>OpenStreetMap</a> contributors',
//     maxZoom: 18,
// }).addTo(map);
//  // create a feature group for Leaflet Draw to hook into for delete functionality
//  var drawnItems = L.featureGroup().addTo(map);
//  map.addLayer(drawnItems);
// // create a new Leaflet Draw control
// var drawControl = new L.Control.Draw({
//     edit: {
//         featureGroup: drawnItems,
//         edit: true 
//     },
//     delete: {
//     },
//     draw: {
//       circle: false, // disable circles
//       marker: false, // disable polylines
//       polyline: false, // disable polylines
//       polygon: {
//         allowIntersection: false, // polygons cannot intersect thenselves
//         drawError: {
//           color: 'red', // color the shape will turn when intersects
//           message: '<strong>Oh snap!<strong> you can\'t draw that!' // message that will show when intersect
//         },
//       }
//     }
//   });
// // add our drawing controls to the map
// map.addControl(drawControl);
// map.on(L.Draw.Event.CREATED, function (e) {
//     var type = e.layerType,
//         layer = e.layer;
//     var coords = layer._latlngs;
//     console.log(coords);
//     var zone = new Zone();
//     zone.type = type;
//     //Length checken of controleren als het een array is. 
//     for(var i=0; i < coords.length; i++){
//         zone.coords = coords[i];
//     }
//     console.log(zone);  
//     // Save to DB and Map 
//     map.addLayer(layer);
//  });
//  map.on('draw:edited', function (e) {
//     var layers = e.layers;
//     console.log(e);
//     layers.eachLayer(function (layer) {
//         //do whatever you want; most likely save back to db
//         console.log(layer);
//     });
// });
// // when we start using creation tools disable our custom editing
// map.on('draw:createstart', function() {
// });
// // when we start using deletion tools, hide attributes and disable custom editing
// map.on('draw:deletestart', function() {
// });
// // when the map is clicked, stop editing
// map.on('click', function(e) {
// });


/***/ }),

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
function getCollection(object) {
    console.log(object.title);
}
function storeCollection(event) {
    event.preventDefault();
    var object = {
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
        location: document.getElementById('location').value
    };
    getCollection(object);
}
// let save_button = document.getElementById('save-collection')
// save_button.onclick = function(event){
//     event.preventDefault()
//     const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
//     api.post('/collection/create', {
//         object
//     })
//     .then(res => {
//         console.log(res)
//     })
//     .catch(error => {
//         console.log(error)
//     })
// };


/***/ }),

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });
function getAudio(object) {
    console.log(object.url);
}
function storeAudio(event) {
    event.preventDefault();
    var object = {
        name: 'cooletrack',
        url: 'resources/ditismijnmooiepath',
        extension: 'mp3',
        length: 9
        // title: (<HTMLInputElement>document.getElementById('title')).value,
        // description: (<HTMLInputElement>document.getElementById('description')).value,
        // location: (<HTMLInputElement>document.getElementById('location')).value
    };
    getAudio(object);
}
var save_audio = document.getElementById('save-audio');
save_audio.onclick = function (event) {
    event.preventDefault();
    //var form = new FormData(<HTMLFormElement>document.getElementById("audio_form"));
    var formData = new FormData();
    var audioFile = document.getElementById('audio-file').value;
    var fileExtension = audioFile.replace(/^.*\./, '');
    console.log('File Extension ' + fileExtension);
    console.log('File ' + audioFile);
    //formData.append("audio", audioFile, audioFile.name)
    var request = new XMLHttpRequest();
    var async = true;
    request.open("POST", "/my_form_handler", async);
    if (async) {
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = null;
                try {
                    response = JSON.parse(request.responseText);
                }
                catch (e) {
                    response = request.responseText;
                }
                console.log(response);
            }
        };
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


/***/ })

/******/ });