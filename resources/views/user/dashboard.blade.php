<x-header>
    ユーザーとしてログインしました！
    {{ Auth::user()->name}}
    <a href="/logout">ログアウト</a>
    <h1>メニュー</h1>
    @if (Session::has('registeredMsg'))
        <div class="text-red-500 ">
        {{ session('registeredMsg') }}
        </div>
    @endif
    <ul class="list-disc m-5">
        <li><a>旅行計画登録</a></li>
        {{-- {{dd($userPlans)}} --}}
        @if(isset($userPlans) && !$userPlans->isEmpty())
        <li><a href="{{ route('showMyPlan', ['id' => $userPlans[0]['id']]) }}">旅行予定を見る</a></li>
        @endif
    </ul>
    @if (isset($userPlans) && !$userPlans->isEmpty())
        <select name="userPlans">
            @foreach ($userPlans as $userPlan)
                <option value="{{ $userPlan['id'] }}">{{ $userPlan['title'] }}</option>
            @endforeach
        </select>
    @endif
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
                旅行名：<input type="text" name="title">
                国名：
                <select name="country">
                    @foreach ($countries as $country)
                        <option value="{{ $country['id'] }}">{{ $country['nameJP'] }}</option>
                    @endforeach
                </select>
                旅行開始日：<input type="date" name="from">
                旅行終了日：<input type="date" name="to">
                <input type="submit" value="登録する">
            </form>
        </div>
        @endif
        <script src="{{ asset('js/toppage.js') }}"></script>
    </div>
</x-header>