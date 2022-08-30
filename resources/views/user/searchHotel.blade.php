<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <h3 class="text-2xl text-center my-[30px]">ホテル検索</h3>
        {{-- 県名middleClassesこの配列1~47に県名が入っている --}}
        <form method="post" action="{{ route('apiHotel') }}" class="flex flex-col w-2/5 my-0 mx-auto">
            @csrf
            <select name="prefecture" onchange="showCities(this.selectedIndex)" class="mb-2.5">
                <option disabled selected>都道府県を選択してください</option>
                @for($i = 0; $i< count($cityData); $i++)
                    <option value="{{ $cityData[$i]['middleClass'][0]['middleClassCode'] }}" middleClassCode="{{ $cityData[$i]['middleClass'][0]['middleClassCode']}}" key="{{ $i }}">{{ $cityData[$i]['middleClass'][0]['middleClassName']}}</option>
                @endfor
            </select>
            {{-- 市のセレクト --}}
            <select name="city" disabled class="mb-2.5">
                <option disabled selected>エリアを選択してください</option>
            </select>
            人数：<select name="people" class="mb-2.5">
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            {{-- @if(request()->session()->missing('start') || request()->session()->missing('end')) --}}
            @if(request()->session()->exists('start'))
                チェックイン：<input type="date" name="start" value="{{ session('start') }}" required>
            @else
                チェックイン：<input type="date" name="start" required>
            @endif
            @if(request()->session()->exists('end'))
                チェックアウト：<input type="date" name="end" value="{{ session('end') }}" required>
            @else
                チェックアウト：<input type="date" name="end" required>
            @endif
            {{-- @endif --}}
            <input type="submit" value="検索">
        </form>
</x-header>
<script>
    const cityData = @json($cityData);
</script>
<script src="{{ mix('js/searchHotel.js') }}"></script>