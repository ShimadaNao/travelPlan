/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/planEdit.js ***!
  \**********************************/
//編集ボタンがクリックされたら、タイトル・日程をinputタグにし編集可能に
window.editBtn = document.querySelector('#editBtn');
window.planChartTitle = document.querySelector('.planChartTitle');

window.editTitle = function () {
  var title = document.querySelector('#planTitle');
  var date = document.querySelector('#planDate');
  window.planChartTitle.innerHTML = "<p style='font-size: 30px; color: violet;'>編集画面中です</p>" + "<form method='post' action=''>タイトル：<input type='text' name='title' value='" + planTitle + "'><br />旅行開始日：<input type='date' value='" + planStart + "'><br />旅行終了日：<input type='date' value='" + planEnd + "'><input type='hidden' name='plan_id' value='" + planId + "'><br /><input type='submit' value='更新'></form>";
};

window.editBtn.onclick = window.editTitle;
/******/ })()
;