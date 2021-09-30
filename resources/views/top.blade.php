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
        <link rel="stylesheet" href="css/Control.OSMGeocoder.css" />
        <script src="{{ mix('js/Control.OSMGeocoder.js') }}"></script>
        {{-- <script src="{{ asset('/js/Control.OSMGeocoder.js') }}"></script> --}}
    </x-slot>
    <p class="text-center">トップページです。</p>
    <div id="map" style="height: 70%">
        <script>
            var map = L.map('map', {
                center: [35.66572, 139.73100],
                zoom: 0,
            });
            //住所検索
            var option = {
                position: 'topright',
                text: '検索',
                placeholder: '入力してください',
            }
            var osmGeocoder = new L.Control.OSMGeocoder(option);
            map.addControl(osmGeocoder);
          var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
          });
          tileLayer.addTo(map);
        </script>
    </div>
</x-header>