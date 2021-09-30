/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/toppage.js ***!
  \*********************************/
var map = L.map('map', {
  center: [35.66572, 139.73100],
  zoom: 0
});
var option = {
  position: 'topright',
  text: '検索',
  placeholder: '入力してください'
};
var osmGeocoder = new L.Control.OSMGeocoder(option);
map.addControl(osmGeocoder);
var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
});
tileLayer.addTo(map);
/******/ })()
;