/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/sharedPlan.js ***!
  \************************************/
// window.show = function(i){
//     console.log(planDetail[i]['plan_detail']);
// }
// function show(i){
//     console.log(i);
// }
window.position = '';
window.position_contents = '';
position = document.querySelector('.position');
position_contents = '<table><tr><th>場所</th><th>日程</th><th>時間</th></tr>'; // window.new_ele = document.createElement('table');
// window.new_tr = document.createElement('tr');
// position.insertBefore(new_tr, position.firstChild);
// new_ele.appendChild(new_tr);
// window.new_ele_text = document.createTextNode('<tr><th>場所</th><th>日程</th><th>時間</th></tr>');
// window.test = new_ele.appendChild(new_ele_text);
// position.insertBefore(new_ele, position.firstChild);

window.show = function (i) {
  position.style.display = "flex";
  planDetail[i]['plan_detail'].forEach(function (ele) {
    // text += '<tr><td>' + ele.name + '</td><td>' + ele.dayToVisit + '</td><td>' + ele.timeToVisit + '</td></tr>';
    position_contents += '<tr><td>' + ele.name + '</td><td>' + ele.dayToVisit + '</td><td>' + ele.timeToVisit + '</td></tr>';
  });
  position_contents += '</table>';
  position.innerHTML = position_contents;
  position.classList.add('position_show');
  var table = document.getElementsByTagName('table')[0];
  table.classList.add('publicPlanDetailTable');
};
/******/ })()
;