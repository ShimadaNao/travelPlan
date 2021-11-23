window.selectedPlan = document.querySelector('[name = "myPlans"]');
var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
console.log(selectedPlan.value);
map.on('click', showForm);
window.nowMarker = '';
var popup = L.popup({
});
function showForm(e) {
    //nowMarkerがなかったらマーカーを立てる処理(addFormでは2つ以上のマーカーを同時に立てられなくするため)
    if(nowMarker == ''){
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
        });
        var planName = document.querySelector('option[value="' + selectedPlan.value + '"]').text;
            var formContent = '<form class="fetchForm">' +
            '<input type="hidden" name="_token" value="' + csrf_token + '">' +
            '旅行地：' + '<input type="text" name="name">' + '<br>' +
            // '旅行地：' + '<input type="text" name="name" value="' + planName + '">' + '<br>' +
            '訪問予定日：' + '<input type="date" name="dayToVisit">' + '<br>' +
            '予定時間：' + '<input type="time" name="timeToVisit">' + '<br>' +
            'コメント' + '<input type="text" name="comment">' + '<br>' +
            '<input type="hidden" name="plan_id" value="' + selectedPlan.value + '">' +
            '<input type="hidden" name="lat" value="' + lat + '">' +
            '<input type="hidden" name="lng" value="' + lng + '">' +
            '<input type="button" value="送信" onclick="postFetch()" class="btn">' +
            '<input type="button" value="削除" onclick="deletePopup()" class="btn">' +
            '</form>';
        popup.setContent(formContent);
        marker.bindPopup(popup);
        marker.addTo(map);
        
        marker.on('click',function(e){
            window.nowMarker = this;
        });
    } else {
        alert('フォームポップアップは1つのみ表示可能です');
    }
}
//ポップアップの削除ボタンを押したときに、マーカーを削除
deletePopup = function(){
    map.removeLayer(window.nowMarker);
    nowMarker = '';
}

// fetchでPOSTしていく
postFetch = function(){
    // postで投げる際のURLを指定
    const url = "/registerPlanDetail";
    const fetchForm = document.querySelector('.fetchForm');
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
        console.log(response);
        return response.json();
    })
    // ちゃんとjson形式にレスポンスを変換(したら)(then)
    // .then(res => res.text())
    // .then(text => console.log(text))
    .then((data) => {
        // consoleでdataを出力しましょう
        console.log(data);

        var formContent = document.querySelector('.fetchForm');
        var content = formContent.elements['name'].value;
        content += '<br>' + '<input type="button" name="deleteBtn" value="削除">';
        formContent.remove();
        // map.removeLayer(nowMarker);
        // var registeredPopup = L.popup({
        //     closeOnClick: false,
        //     autoClose: false
        // });
        
        popup.setContent(content);
        // nowMarker.bindPopup(popup);
        // var content = planInfo.title + '<br>' + planDetails[i].name;
        //             if(planDetails[i].dayToVisit) {
        //                 var date = planDetails[i].dayToVisit.split('-');
        //                 date = date[0] + '年' + date[1] + '月' + date[2] + '日';
        //                 content += '<br>' + '訪問日：' + date;
        //             }
        //             if(planDetails[i].timeToVisit) {
        //                 var time = planDetails[i].timeToVisit.split(':');
        //                 time = time[0] + '時' + time[1] + '分';
        //                 content += '<br>' + '予定時間；' + time;
        //             }
        //             if(planDetails[i].comment) {
        //                 content += '<br>' + '!コメント!' + '<br>' + planDetails[i].comment;
        //             }
        //             content += '<br>' + '<input type="button" value="削除" id="deletePlanDetail" onclick="deletePlanDetail('+ planDetails[i].id + ')" class="btn">';
        //             content += '<br>' + '<input type="hidden" name="planDetail_id" value="' + planDetails[i].id + '">';
        //             selectedPlanDetail = planDetails[i];
        nowMarker = '';
    })
    .catch((error) => {
        console.log(error)
    });
};
function clickMarkers(e) {
    map.removeLayer(e.target);
}
