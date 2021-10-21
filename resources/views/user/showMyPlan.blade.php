<x-header>
    <x-slot name="leafletCss">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin=""/>
    </x-slot>
    <x-slot name="leafletJavaScript">
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin="">
        </script>
    </x-slot>
    <x-slot name="addressPlugin">
        <link rel="stylesheet" href="/css/Control.OSMGeocoder.css" />
        <script src="{{ mix('js/Control.OSMGeocoder.js') }}"></script>
    </x-slot>
    @if(session('msg'))
        {{session('msg')}}
    @endif
    <div class="selectMyPlan flex justify-center">
        <select name="myPlans" class="m-3">
            @foreach ($myPlans as $myPlan)
                @if (isset($nowRegisteredPlan)) {{-- 新規登録したらそのプランを表示 --}}
                    <option value="{{ $myPlan['id'] }}" {{ $nowRegisteredPlan['id'] == $myPlan['id'] ? 'selected': ''}}>{{ $myPlan['title'] }}</option>
                @else
                    <option value="{{ $myPlan['id'] }}">{{ $myPlan['title'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div id="map">
        <script src="{{ mix('js/toppage.js') }}"></script>
        {{-- <script src="{{ mix('js/showSelectedPlan.js') }}"></script> --}}
    </div>
</x-header>
<script>
    //予定を見るからきたら、セレクトボックスの最初に表示されるプランの位置へ移動。新規登録から来たときは、そのプランの位置へ移動
    var firstShowPlan = @json($firstShowPlan);
    var firstShowLat = firstShowPlan['country']['lat'];
    var firstShowLng = firstShowPlan['country']['lng'];
    map.setView([firstShowLat, firstShowLng]);

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
</script>