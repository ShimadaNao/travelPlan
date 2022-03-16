<x-header>
    <div style="display: flex; align-items:center; justify-content:center;">
    <p>管理者としてログインしました！</p>
    {{-- <h3 class="text-2xl">管理者メニュー</h3>
    <ul>
        <li class="list-disc m-5"><a>国名登録</a></li> --}}
    {{-- <a href="/logout">ログアウト</a> --}}
    </ul>
    </div>
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
    <div id="map">
    </div>
    <script src="{{ mix('js/toppage.js') }}"></script>
</x-header>