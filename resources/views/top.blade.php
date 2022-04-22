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
    </x-slot>
    <p class="text-center">トップページです。</p>
    <div id="map" style="height: 70%">
        <script>
            var places = {};
            places = @json($places);
        </script>
        @if(app('env') == 'production')
            <link href="{{ secure_asset('js/toppage.js') }}" rel="stylesheet">
        @else
            <link href="{{ asset('js/toppage.js') }}" rel="stylesheet">
        @endif
        {{-- <script src="{{ asset('js/toppage.js') }}"></script> --}}
    </div>
</x-header>