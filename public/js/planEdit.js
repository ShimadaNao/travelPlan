/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/planEdit.js ***!
  \**********************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

//編集ボタンがクリックされたら、タイトル・日程をinputタグにし編集可能に
window.editBtn = document.querySelector('#editBtn');
window.planChartTitle = document.querySelector('.planChartTitle');
window.csrf_token = document.querySelector('meta[name="csrf-token"]').content;
window.excludables = [];
window.str = '';

window.editTitle = function () {
  var title = document.querySelector('#planTitle');
  var date = document.querySelector('#planDate');
  var editForm = "<p style='font-size: 30px; color: violet;'>編集画面中です</p>" + "<form class='updateForm'><dl><dt>タイトル：</dt><dd><input type='text' name='title' value='" + planTitle + "'></dd><dt>旅行開始日：</dt><dd><input type='date' name='start' value='" + planStart + "'></dd><dt>旅行終了日：</dt><dd><input type='date' name='end' value='" + planEnd + "'></dd></dl><input type='hidden' name='plan_id' value='" + planId + "'><input type='hidden' name='_token' value='" + csrf_token + "'><br /><input type='button' value='送信' onclick='window.confirmExcludables()'></form>";
  window.planChartTitle.innerHTML = editForm;
};

window.editBtn.onclick = window.editTitle; //追加 ここでfetchでしてLaravel側で処理を書く

window.confirmExcludables = function () {
  var fetchForm = document.querySelector('.updateForm');
  var url = '/users/confirmExcludableDetail';
  var formData = new FormData(fetchForm);

  var _iterator = _createForOfIteratorHelper(formData.entries()),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var value = _step.value;
      console.log(value);
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  fetch(url, {
    method: "POST",
    body: formData
  }).then(function (response) {
    console.log('ok!');
    return response.json();
  }).then(function (data) {
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        window.excludables.push('・' + data[i]['name']);
      }

      str = excludables.reduce(function (a, b) {
        // return '・' + a + `\n` + '・' + b + `\n`;
        return a + "\n" + b;
      });
      var result = confirm(str + '\n上記予定は旅行日程から外れるため削除されます。'); //confirmがokだったら旅行名を更新できるようにする

      if (result) {
        //excludablesの予定をplanDetailテーブルから削除処理
        window.updatePlan();
      }
    } else {
      window.updatePlan();
    }

    console.log(window.excludables);
    window.excludables = [];
  })["catch"](function (error) {
    console.log(error);
  });
}; //ここまで追加


window.updatePlan = function () {
  var postFetchForm = document.querySelector('.updateForm');
  var url = '/users/updatePlan';
  var formData = new FormData(postFetchForm);

  var _iterator2 = _createForOfIteratorHelper(formData.entries()),
      _step2;

  try {
    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
      var value = _step2.value;
      console.log(value);
    }
  } catch (err) {
    _iterator2.e(err);
  } finally {
    _iterator2.f();
  }

  fetch(url, {
    method: "POST",
    body: formData
  }).then(function (response) {
    if (!response.ok) {
      console.log('error!');
    }

    console.log('ok!');
    return response.text();
  }).then(function (data) {
    //きちんと更新できていたらページを再読み込みして編集画面じゃなくする
    if (data == '更新しました') {
      window.location.reload();
      alert('更新しました！');
    } else if (!window.planChartTitle.querySelector('div')) {
      //更新失敗したらエラーを表示
      msgPlace = window.planChartTitle.querySelector('p');
      var new_element = document.createElement('div');
      new_element.textContent = '更新内容を確認してください';
      msgPlace.after(new_element);
    }
  })["catch"](function (error) {
    console.log(error);
  });
};
/******/ })()
;