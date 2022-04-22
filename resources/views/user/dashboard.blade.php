<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav selec">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav ">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="menu-wrapper">
        <div class="menu-body">
            <p>{{ Auth::user()->name}}さんはユーザーとしてログインしました！</p>
            @if (Session::has('registeredMsg'))
                <div class="text-red-500 ">
                    {{ session('registeredMsg') }}
                </div>
            @endif
            @if (isset($message))
                <div class="text-red-500 ">
                    {{ $message }}
                </div>
            @endif
            <ul class="list-disc m-5">
            </ul>
        </div>
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
        @if (isset($countries))
        <div class="planTitleWrapper">
            <form method="post" action="{{ route('registerTravelTitle') }}" class="planTitle">
                @csrf
                <h2 class="text-base">旅行名を登録してください</h2>
                @if ($errors->has('title'))
                    <div class="text-red-600">
                        {{ $errors->first('title')}}
                    </div>
                @endif
                旅行名：<input type="text" name="title" value="{{ old('title') }}"><br>
                @if ($errors->has('country'))
                    <div class="text-red-600">
                        {{ $errors->first('title')}}
                    </div>
                @endif
                国名：
                <select name="country">
                    @foreach ($countries as $country)
                        <option value="{{ $country['id'] }}">{{ $country['nameJP'] }}</option>
                    @endforeach
                </select><br>
                @if ($errors->has('start'))
                    <div class="text-red-600">
                        {{ $errors->first('start')}}
                    </div>
                @endif
                旅行開始日：<input type="date" name="start" value="{{ old('start') }}"><br>
                @if ($errors->has('end'))
                    <div class="text-red-600">
                        {{ $errors->first('end')}}
                    </div>
                @endif 
                旅行終了日：<input type="date" name="end" value="{{ old('end') }}"><br>
                @if ($errors->has('public'))
                    <div class="text-red-600">
                        {{ $errors->first('public')}}
                    </div>
                @endif 
                <p>公開・非公開を選んでください</p>
                <div class="openness">
                    <div>
                        <input type="radio" name="public" value="yes">
                        <label for="yes">公開</label>
                    </div>
                    <div>
                        <input type="radio" name="public" value="no">
                        <label for="no">非公開</label>
                    </div>
                </div>
                <input type="submit" value="登録する">
            </form>
        </div>
        @endif
        @if(app('env') == 'production')
            <script src="{{ secure_asset('js/toppage.js') }}"></script>
        @else
            <script src="{{ asset('js/toppage.js') }}"></script>
        @endif
        {{-- <script src="{{ asset('js/toppage.js') }}"></script> --}}
    </div>
</x-header>