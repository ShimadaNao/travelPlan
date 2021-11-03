var selectedPlan = document.querySelector('[name = "myPlans"]');
var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
console.log(selectedPlan.value);
map.on('click', showForm);
function showForm(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    var marker = L.marker([lat, lng]);
    var popup = L.popup({
        autoClose: false,
        closeOnClick: false,
    });
    var formContent = '<form class="fetchForm">' +
        '<input type="hidden" name="_token" value="' + csrf_token + '">' +
        '旅行地：' + '<input type="text" name="name">' + '<br>' +
        '訪問予定日：' + '<input type="date" name="dayToVisit">' + '<br>' +
        '予定時間：' + '<input type="time" name="timeToVisit">' + '<br>' +
        'コメント' + '<input type="text" name="comment">' + '<br>' +
        '<input type="hidden" name="plan_id" value="' + selectedPlan.value + '">' +
        '<input type="hidden" name="lat" value="' + lat + '">' +
        '<input type="hidden" name="lng" value="' + lng + '">' +
        '<input type="button" value="送信" onclick="postFetch()" class="btn">' +
        '</form>';
    popup.setContent(formContent);
    marker.bindPopup(popup);
    marker.addTo(map);
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
        return response.text();
    })
    // ちゃんとjson形式にレスポンスを変換(したら)(then)
    // .then(res => res.text())
    // .then(text => console.log(text))
    .then((data) => {
        // consoleでdataを出力しましょう
        console.log(data);
    })
    .catch((error) => {
        console.log(error)
    });
};