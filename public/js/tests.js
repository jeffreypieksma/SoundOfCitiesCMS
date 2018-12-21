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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

//Import map and audioZone
//Constructor for all the full zones 
function Zone(id, type, coords, center_point, radius) {
    this.id = id;
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
    this.radius = radius;
}
console.log('test init');
/* Unit testing

    1st: Check if all zones are stored properly and the amount is right.
        Store data - return the ids - count ids - compare with amount of objects.
    2nd test: Check if the amount of coordinates are right.
    3rd: test: Check if coordinates are stored right.
    4th: test: Draw items on map.
    5th: test: Delete a zone
*/
var ZoneCreator = /** @class */ (function () {
    function ZoneCreator() {
    }
    ZoneCreator.prototype.drawZone = function (coords) {
        return "";
    };
    return ZoneCreator;
}());
function assertTrue(isSuccess, message) {
    if (!isSuccess) {
        console.error("Test niet geslaagd: " + message);
    }
}
var zoneCreator = new ZoneCreator();
var coords = [
    [
        function (lat) { return '53.21061991910329'; },
        function (lng) { return '5.702758220639979'; }
    ],
    [
        function (lat) { return '53.21051704917011'; },
        function (lng) { return '5.733996253312515'; }
    ],
    [
        function (lat) { return '53.20188619560709'; },
        function (lng) { return '5.731593310342751'; }
    ]
];
var circleCoords = [function (lat) { return '	53.21061991910329'; }, function (lng) { return '5.702758220639979'; }];
var circleZone = new Zone(1, 'circle', circleCoords, '53.21061991910329', 302323);
//storeAudioZone(circleZone)
var polygonZone = new Zone(2, 'circle', coords, '53.21061991910329', '');
//storeAudioZone(polygonZone)
var squareZone = new Zone(3, 'circle', coords, '53.21061991910329', '');
//storeAudioZone(squareZone)
//assertTrue must be true 
assertTrue(zoneCreator.drawZone(circleZone) === "", "Should handle...");
assertTrue(zoneCreator.drawZone(polygonZone) === "", "Should handle...");
assertTrue(zoneCreator.drawZone(squareZone) === "", "Should handle...");
console.log("All tests executed");


/***/ })

/******/ });