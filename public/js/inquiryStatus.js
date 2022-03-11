/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/inquiryStatus.js ***!
  \***************************************/
var select = document.getElementsByTagName('select')[0];
var selectValue = '';
var waiting = document.getElementsByClassName('waiting')[0];
var done = document.getElementsByClassName('done')[0];
select.addEventListener('change', function () {
  selectValue = select.value;

  if (selectValue === '1') {
    waiting.style.display = 'block';
    done.style.display = "none";
  } else {
    done.style.display = 'block';
    waiting.style.display = "none";
  }
});
/******/ })()
;