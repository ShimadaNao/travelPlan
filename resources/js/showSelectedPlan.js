var selected = document.querySelector('[name="myPlans"]');
var countryLatLng = {};
selected.onchange = event => {
    getData("/show_MyPlan/"+selected.value)
        .then(data => {
        //    console.log(data); // `data.json()` の呼び出しで解釈された JSON データ
           moveToCountry(data); // 緯度と経度のデータ渡すから、マーカー処理してね
        });
        }

// 緯度と経度のデータをもらったのでマーカーの処理をしますね
var moveToCountry = function(data){
    countryLatLng = data[1]; //国の緯度・経度をcountryLatLngに代入
    console.log(countryLatLng);
    //ここで移動の処理を書いていく
    map.setView([countryLatLng["lat"], countryLatLng["lng"]]);
};
async function getData(url = '') {
    // 既定のオプションには * が付いています
    const response = await fetch(url, {
        method: 'GET', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
        'Content-Type': 'application/json'
        },
        referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    })
    return response.json(); // レスポンスの JSON を解析
};