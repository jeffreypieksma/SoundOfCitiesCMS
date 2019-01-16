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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

"use strict";
function Zone(id, type, coords, center_point, radius) {
    this.id = id;
    this.type = type;
    this.coords = coords;
    this.center_point = center_point;
    this.radius = radius;
}
var ZoneCreator = /** @class */ (function () {
    function ZoneCreator() {
    }
    ZoneCreator.prototype.drawZone = function (zone) {
        return zone.coords.length;
    };
    ZoneCreator.prototype.drawCircleZone = function (zone) {
        return zone.coords.length;
    };
    ZoneCreator.prototype.drawPolyZone = function (zone) {
        return zone.coords.length;
    };
    return ZoneCreator;
}());
var zoneCreator = new ZoneCreator();
var circleCoords = new Array({ 'lat': '53.21061991910329', 'lng': '5.702758220639979' });
var polyCoords = new Array({ 'lat': '53.21061991910329', 'lng': '5.702758220639979' }, { 'lat': '53.21051704917011', 'lng': '5.733996253312515' }, { 'lat': '53.20188619560709', 'lng': '5.731593310342751' });
var circleZone = new Zone(1, 'circle', circleCoords, '53.21061991910329', 302323);
var polyZone = new Zone(2, 'polygon', polyCoords, '', '');
function assertTrue(isSuccess, message) {
    if (!isSuccess) {
        console.error("Test not succeed: " + message);
    }
}
//assertTrue must be true to succeed test
assertTrue(zoneCreator.drawCircleZone(circleZone) == '1', "Should return 1s");
assertTrue(zoneCreator.drawPolyZone(polyZone) == '3', "Should return 3");
console.log("Tests executed");


/***/ })

/******/ });