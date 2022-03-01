/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/sharedPlan.js ***!
  \************************************/
window.position = '';
window.position_contents = '';
position = document.querySelector('.position');
window.cross = document.getElementsByClassName('cross')[0];

window.show = function (i) {
  position.style.display = "flex";
  position_contents = '<svg class="cross h-6 w-6 fill-current" viewBox="0 0 24 24"><path v-show="isOpen" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" fill="black"/></svg>';

  if (planDetail[i]['plan_detail'].length > 0) {
    position_contents += '<table class="publicPlanDetailTable"><caption class="caption">' + planDetail[i]['title'] + '</caption><tr><th class="w-1/2 px-4 py-2">場所</th><th class="w-1/2 px-4 py-2">日程</th><th class="w-1/2 px-4 py-2">時間</th></tr>';
    planDetail[i]['plan_detail'].forEach(function (ele) {
      var splitDate = ele.dayToVisit.split('-');
      var trimmedDate = splitDate[0] + '年' + splitDate[1] + '月' + splitDate[2] + '日';
      position_contents += '<tr><td class="border px-4 py-2 .border-white">' + ele.name + '</td><td class="border px-4 py-2 .border-white">' + trimmedDate + '</td><td class="border px-4 py-2 .border-white">' + ele.timeToVisit.substr(0, 5) + '</td></tr>';
    });
    position_contents += '</table>';
    position.innerHTML = position_contents;
    position.classList.add('position_show');
    var table = document.getElementsByTagName('table')[0];
    table.classList.add('publicPlanDetailTable');
    window.getCross();
    cross.onclick = crossClick;
  } else {
    position_contents += '<p class="caption">' + planDetail[i]['title'] + '</p><p>表示するコンテンツがありません</p>';
    position.classList.add('publicNoDetail');
    position.innerHTML = position_contents;
    window.getCross();
    cross.onclick = crossClick;
  }
};

window.getCross = function () {
  cross = document.getElementsByClassName('cross')[0];
  cross.classList.add('showCross');
};

window.crossClick = function () {
  if (position.style.display == 'flex') {
    position.style.display = 'none';
    position_contents = '';

    if (position.classList.contains('position_show')) {
      position.classList.remove('position_show');
    } else {
      position.classList.remove('publicNoDetail');
    }
  }
};
/******/ })()
;