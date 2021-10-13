var map = L.map('map', {
    center: [37.5598, 126.9862],
    zoom: 16,
});

if(typeof places !== 'undefined'){
    for (let i = 0; i < places.length; i++){
        console.log(places[i]['position']);
        L.marker(places[i]['position']).addTo(map);
    }
    L.marker([35.66572, 139.73100]).addTo(map); 
}

var option = {
    position: 'topright',
    text: '検索',
    placeholder: '入力してください',
}
var osmGeocoder = new L.Control.OSMGeocoder(option);

// map.on('click', function(e){
//     lat = e.latlng.lat;
//     lng = e.latlng.lng;
//     alert('クリックした位置情報は　緯度:'+ lat + '経度' + lng + 'です！');
// });
map.addControl(osmGeocoder);
var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
});
tileLayer.addTo(map);