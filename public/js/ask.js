/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************!*\
  !*** ./resources/js/ask.js ***!
  \*****************************/
window.onload = function () {
  if (window.confirm('ホテルは予約しましたか?')) {
    window.location.href = '/users/showMyPlan/' + registeredPlanId;
  } else {
    window.location.href = '/users/searchHotel';
  }
};
/******/ })()
;