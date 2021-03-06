/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./resources/js/addPlanDetailByClick.js ***!
  \**********************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

window.futurePlans = window.futurePlans;
window.selectedPlan = document.querySelector('[name = "myPlans"]');
var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
console.log(selectedPlan.value);
map.on('click', showForm);
window.markersOnDisplay = {};
window.nowMarker = '';
window.fetchForm = '';
window.postedPopupContent = '';
var popup = L.popup({});

function showForm(e) {
  nowMarker = this;
  var lat = e.latlng.lat;
  var lng = e.latlng.lng; //?????????????????????
  // var icon = L.icon({
  //     iconUrl: 'public/images/icon.png', 
  // });
  // var marker = L.marker([lat, lng], { icon: icon });

  var marker = L.marker([lat, lng]);
  popup = L.popup({
    closeOnClick: false,
    autoClose: false
  });
  var travelPeriod = document.querySelector(".selectMyPlan");
  var start = travelPeriod.getAttribute("start");
  var end = travelPeriod.getAttribute("end");
  var planName = document.querySelector('option[value="' + selectedPlan.value + '"]').text;
  var formContent = '<form class="fetchForm">' + '<input type="hidden" name="_token" value="' + csrf_token + '">' + '????????????' + '<input type="text" name="name">' + '<br>' + '??????????????????' + '<input type="date" name="dayToVisit" min="' + start + '" max= "' + end + '">' + '<br>' + '???????????????' + '<input type="time" name="timeToVisit">' + '<br>' + '????????????' + '<input type="text" name="comment">' + '<br>' + '<input type="hidden" name="plan_id" value="' + selectedPlan.value + '">' + '<input type="hidden" name="lat" value="' + lat + '">' + '<input type="hidden" name="lng" value="' + lng + '">' + '<input type="button" value="??????" onclick="postFetch(event)" class="btn">' + '<input type="button" value="??????" onclick="deletePopup(event)" class="btn">' + '</form>';
  popup.setContent(formContent);
  marker.bindPopup(popup);
  marker.addTo(map);
  markersOnDisplay[e.latlng.lat] = marker;
  marker.on('click', function (e) {
    window.nowMarker = this;
  });
} //?????????????????????????????????????????????????????????????????????????????????


deletePopup = function deletePopup(e) {
  var targetFetchForm = e.currentTarget.closest('.fetchForm');
  var lat = targetFetchForm.querySelector('input[name="lat"]').value;
  var stringLat = Number(lat);
  map.removeLayer(markersOnDisplay[stringLat]);
  delete markersOnDisplay[stringLat]; // map.removeLayer(window.nowMarker);
  // nowMarker = '';
}; // fetch???POST????????????


postFetch = function postFetch(e) {
  // post??????????????????URL?????????
  var url = "/registerPlanDetail"; //event?????????????????????????????????????????????????????????????????????

  var btn = e.currentTarget;
  fetchForm = btn.closest('.fetchForm');
  window.postedPopupContent = e.path[2]; // ???????????????POST????????????BODY????????????????????????

  var formData = new FormData(fetchForm); // ????????????????????????????????????

  var _iterator = _createForOfIteratorHelper(formData.entries()),
      _step;

  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var value = _step.value;
      console.log(value);
    } // url????????????BODY???????????????POST??????

  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }

  fetch(url, {
    method: 'POST',
    body: formData // ??????????????????POST(????????????)(then)
    // console???ok?????????????????????

  }).then(function (response) {
    console.log('ok'); // console.log(response);

    return response.json();
  }).then(function (data) {
    console.log(data);
    var formContent = fetchForm; //??????????????????

    var registeredInfo = data[1];
    var content = '<form class="fetchForm">' + '<input type="hidden" name="_token" value="' + csrf_token + '">' + '????????????' + '<input type="text" name="planDetailName" value="' + registeredInfo['name'] + '" disabled>';

    if (registeredInfo.dayToVisit) {
      var date = registeredInfo.dayToVisit;
      content += '<br>' + '????????????' + '<input type="date" name="date" value="' + date + '" disabled>';
    }

    if (registeredInfo.timeToVisit) {
      var time = registeredInfo.timeToVisit.split(':');
      time = time[0] + ':' + time[1];
      content += '<br>' + '???????????????' + '<input type="time" name="time" value="' + time + '" disabled>';
    }

    if (registeredInfo.comment) {
      content += '<br>' + '<div class="commentTag">' + '!????????????!' + '<br>' + '<input type="text" name="comment" value="' + registeredInfo.comment + '" disabled>' + '</div>';
    }

    content += '<br>' + '<input type="button" value="??????" id="editPlanDetail" onclick="window.editPlanDetail(event,' + registeredInfo.id + ')" class="editBtn">';
    content += '<br>' + '<input type="button" value="??????"  onclick="updatePlanDetail(event,' + registeredInfo.id + ')" class="updateBtn" class="bg-black" disabled>';
    content += '<br>' + '<input type="button" value="??????" id="deletePlanDetail" onclick="window.deletePlanDetail(' + registeredInfo.id + ')" class="btn">';
    content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + registeredInfo.id + '">' + '</form>'; //??????????????????
    //????????????leaflet?????????????????????????????????

    var lat = fetchForm.querySelector('input[name="lat"]').value;
    lat = Number(lat);
    var posted = markersOnDisplay[lat];
    posted._popup._content = content; //????????????leaflet?????????????????????????????????
    //????????????javascript?????????

    window.postedPopupContent.innerHTML = content; //?????????????????????

    nowPlan[registeredInfo.id] = posted;
    window.nowMarker = '';
  })["catch"](function (error) {
    console.log(error);
  });
};

function clickMarkers(e) {
  map.removeLayer(e.target);
}
/******/ })()
;