/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/addPlanDetailByClick.js ***!
  \**********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var selectedPlan = document.querySelector('[name = "myPlans"]');
var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
console.log(selectedPlan.value);
map.on('click', showForm);
nowMarker = '';

function showForm(e) {
  var lat = e.latlng.lat;
  var lng = e.latlng.lng;
  var marker = L.marker([lat, lng]);
  var popup = L.popup({});
  var formContent = '<form class="fetchForm">' + '<input type="hidden" name="_token" value="' + csrf_token + '">' + '旅行地：' + '<input type="text" name="name">' + '<br>' + '訪問予定日：' + '<input type="date" name="dayToVisit">' + '<br>' + '予定時間：' + '<input type="time" name="timeToVisit">' + '<br>' + 'コメント' + '<input type="text" name="comment">' + '<br>' + '<input type="hidden" name="plan_id" value="' + selectedPlan.value + '">' + '<input type="hidden" name="lat" value="' + lat + '">' + '<input type="hidden" name="lng" value="' + lng + '">' + '<input type="button" value="送信" onclick="postFetch()" class="btn">' + '<input type="button" value="削除" onclick="deletePopup()" class="btn">' + '</form>';
  popup.setContent(formContent);
  marker.bindPopup(popup);
  marker.addTo(map);
  marker.on('click', function (e) {
    //マーカーが既にあったら(nowMarkerが生成されていたらnowMarkerを空にしてlayerを削除)
    if (!nowMarker == '') {
      map.removeLayer(nowMarker);
      nowMarker = '';
    }

    nowMarker = marker;
  }); // nowMarkerの緯度経度が今のクリックしたマーカーの緯度経度と違うかったらnowMarkerのマーカーを削除
} //ポップアップの削除ボタンを押したときに、マーカーを削除


deletePopup = function deletePopup() {
  map.removeLayer(nowMarker);
}; // fetchでPOSTしていく


postFetch = function postFetch() {
  // postで投げる際のURLを指定
  var url = "/registerPlanDetail";
  var fetchForm = document.querySelector('.fetchForm'); // これだけでPOSTする際のBODYの値が定義できる

  var formData = new FormData(fetchForm); // 実際に値を見てみましょう

  var _iterator = _createForOfIteratorHelper(formData.entries()),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var value = _step.value;
      console.log(value);
    } // urlに向けてBODYを付与してPOSTする

  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  fetch(url, {
    method: 'POST',
    body: formData // よしちゃんとPOST(されたら)(then)
    // consoleにokを出しましょう

  }).then(function (response) {
    console.log('ok');
    console.log(response);
    return response.text();
  }) // ちゃんとjson形式にレスポンスを変換(したら)(then)
  // .then(res => res.text())
  // .then(text => console.log(text))
  .then(function (data) {
    // consoleでdataを出力しましょう
    console.log(data);
  })["catch"](function (error) {
    console.log(error);
  });
};

function clickMarkers(e) {
  map.removeLayer(e.target);
}
/******/ })()
;