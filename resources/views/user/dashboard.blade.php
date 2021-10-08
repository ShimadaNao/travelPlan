<x-header>
ユーザーとしてログインしました！
<a href="/multi_login/logout">ログアウト</a>
<h1>メニュー</h1>
    <ul class="list-disc m-5">
        <li><a>旅行計画登録</a></li>
        <li><a>旅行予定を見る</a></li>
    </ul>
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
        <div class="planTitleWrapper">
            <form class="planTitle">
                @csrf
                <h2>new plan</h2>
                <input type="text" name="title">
                <input type="text" name="country">
            </form>
        </div>
        <script src="{{ asset('js/toppage.js') }}"></script>
    </div>
</x-header>