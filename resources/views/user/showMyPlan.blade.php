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
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav selec">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="showMyPlanFMsg">
        <div class="msg">
            @if(session('msg'))
                {{session('msg')}}
            @endif
            @if(session('registeredMsg'))
                <p style="color:hotpink;">{{ session('registeredMsg') }}</p>
            @endif
        </div>
    </div>
    <div class="selectMyPlan" start="{{ $firstShowPlan['start'] }}" end="{{ $firstShowPlan['end'] }}">
        <select name="myPlans" class="m-3">
            @foreach ($futurePlans as $futurePlan)
                @if (isset($nowRegisteredPlan)) {{-- 新規登録したらそのプランを表示 --}}
                    <option value="{{ $futurePlan['id'] }}" {{ $nowRegisteredPlan['id'] == $futurePlan['id'] ? 'selected': ''}}>{{ $futurePlan['title'] }}</option>
                @else
                    <option value="{{ $futurePlan['id'] }}">{{ $futurePlan['title'] }}</option>
                @endif
            @endforeach
            @if(!$pastPlans->isEmpty())
                <option disabled>--過去の旅行プランです--</option>
                @foreach ($pastPlans as $pastPlan)
                    @if (isset($nowRegisteredPlan))
                        <option class="bg-gray-400" value="{{ $pastPlan['id'] }}" {{ $nowRegisteredPlan['id'] == $pastPlan['id'] ? 'selected' : ''}}>{{ $pastPlan['title'] }}</option>
                    @else
                        <option class="bg-gray-400" value="{{ $pastPlan['id'] }}">{{ $pastPlan['title'] }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
    <div id="map">
        <script src="{{ mix('js/toppage.js') }}"></script>
        <script>
            window.firstShowPlan = '';
            window.firstShowPlan = @json($firstShowPlan);
            window.futurePlans = '';
            window.futurePlans = @json($futurePlans);
        </script>
        <script src="{{ mix('js/showSelectedPlan.js') }}"></script>
        <script src="{{ mix('js/addPlanDetailByClick.js') }}"></script>
    </div>
</x-header>