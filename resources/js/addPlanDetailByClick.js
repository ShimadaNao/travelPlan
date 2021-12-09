window.futurePlans = window.futurePlans;
window.selectedPlan = document.querySelector('[name = "myPlans"]');
var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
console.log(selectedPlan.value);
map.on('click', showForm);
window.markersOnDisplay = {};
window.nowMarker = '';
window.fetchForm = '';
// window.postedPopupContent = '';
var popup = L.popup({
});
function showForm(e) {
    nowMarker = this;
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    //任意のアイコン
    // var icon = L.icon({
    //     iconUrl: 'public/images/icon.png', 
    // });
    // var marker = L.marker([lat, lng], { icon: icon });
    var marker = L.marker([lat, lng]);
    popup = L.popup({
        closeOnClick: false,
        autoClose: false,
    });
    var travelPeriod = document.querySelector(".selectMyPlan");
    var start = travelPeriod.getAttribute("start");
    var end = travelPeriod.getAttribute("end");
    var planName = document.querySelector('option[value="' + selectedPlan.value + '"]').text;
    var formContent = '<form class="fetchForm">' +
    '<input type="hidden" name="_token" value="' + csrf_token + '">' +
    '旅行地：' + '<input type="text" name="name">' + '<br>' +
    '訪問予定日：' + '<input type="date" name="dayToVisit" min="' + start  +'" max= "'+ end + '">' + '<br>' +
    '予定時間：' + '<input type="time" name="timeToVisit">' + '<br>' +
    'コメント' + '<input type="text" name="comment">' + '<br>' +
    '<input type="hidden" name="plan_id" value="' + selectedPlan.value + '">' +
    '<input type="hidden" name="lat" value="' + lat + '">' +
    '<input type="hidden" name="lng" value="' + lng + '">' +
    '<input type="button" value="送信" onclick="postFetch(event)" class="btn">' +
    '<input type="button" value="削除" onclick="deletePopup(event)" class="btn">' +
    '</form>';
    popup.setContent(formContent);
    marker.bindPopup(popup);
    marker.addTo(map);
    markersOnDisplay[e.latlng.lat] = marker;
    marker.on('click',function(e){
        window.nowMarker = this;
    });
}
//ポップアップの削除ボタンを押したときに、マーカーを削除
deletePopup = function(e){
    var targetFetchForm = e.currentTarget.closest('.fetchForm');
    var lat = targetFetchForm.querySelector('input[name="lat"]').value;
    var stringLat = Number(lat);
    map.removeLayer(markersOnDisplay[stringLat]);
    delete markersOnDisplay[stringLat];
    // map.removeLayer(window.nowMarker);
    // nowMarker = '';
}

// fetchでPOSTしていく
postFetch = function(e){
    // postで投げる際のURLを指定
    const url = "/registerPlanDetail";
    //eventオブジェクトで送信ボタンを押したフォームを送信
    var btn = e.currentTarget;
    fetchForm = btn.closest('.fetchForm');
    // window.postedPopupContent = e.path[2];
    // これだけでPOSTする際のBODYの値が定義できる
    let formData = new FormData(fetchForm);
    // 実際に値を見てみましょう
    for (let value of formData.entries()) {
        console.log(value);
    }
    // urlに向けてBODYを付与してPOSTする
    fetch(url, {
        method: 'POST',
        body: formData,
    // よしちゃんとPOST(されたら)(then)
    // consoleにokを出しましょう
    })
    .then((response) => {
        console.log('ok');
        // console.log(response);
        return response.json();
    })
    .then((data) => {
        console.log(data);
        var formContent = fetchForm;
        //ここから追加
        var registeredInfo = data[1];
        var content = '<form class="fetchForm">' +
        '<input type="hidden" name="_token" value="' + csrf_token + '">' +
        '<input type="text" name="planDetailName" value="' + registeredInfo['name'] + '" disabled>' + '<br>';
        if(registeredInfo.dayToVisit) {
        var date = registeredInfo.dayToVisit;
        content += '<br>' + '訪問日：' + '<input type="date" name="date" value="' + date + '" disabled>';
        }
        if(registeredInfo.timeToVisit) {
            var time = registeredInfo.timeToVisit.split(':');
            time = time[0] + ':' + time[1];
            content += '<br>' + '予定時間；' +'<input type="time" name="time" value="' + time + '" disabled>';
        }
        if(registeredInfo.comment) {
            content += '<br>' + '<div class="commentTag">' +'!コメント!' + '<br>' + '<input type="text" name="comment" value="' +  registeredInfo.comment + '" disabled>' + '</div>';
        }
        content += '<br>' + '<input type="button" value="編集" id="editPlanDetail" onclick="window.editPlanDetail(event,' + registeredInfo.id + ')" class="editBtn">';
        content += '<br>' + '<input type="button" value="更新"  onclick="updatePlanDetail(event,' + registeredInfo.id + ')" class="updateBtn" class="bg-black" disabled>';
        content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="window.deletePlanDetail('+ registeredInfo.id + ')" class="btn">';
        content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + registeredInfo.id + '">' + '</form>';
                    //ここまで追加
        formContent.remove();
        popup.setContent(content);
        // window.postedPopupContent.innerText = content;
        nowPlan[registeredInfo.id] = window.nowMarker;
        window.nowMarker = '';
    })
    .catch((error) => {
        console.log(error)
    });
};
function clickMarkers(e) {
    map.removeLayer(e.target);
}
