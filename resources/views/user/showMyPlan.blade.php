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
        <script>
            window.firstShowPlan = '';
            window.firstShowPlan = @json($firstShowPlan);
        </script>
        <script src="{{ mix('js/showSelectedPlan.js') }}"></script>
    </div>
</x-header>