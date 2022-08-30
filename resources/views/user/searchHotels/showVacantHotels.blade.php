<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    {{-- とりあえず30件表示の実装 --}}
    {{-- {{dd(count($hotels))}} --}}
    <div class="showHotels" style="display: flex; flex-wrap:wrap" class="flex flex-wrap">
        @for($i = 0; $i<30; $i++)
            @if($i>=count($hotels))
                @break;
            @endif
            <div class="w-[33%] p-[20px]">
                <a href="{{ $hotels[$i]['hotel'][0]['hotelBasicInfo']['hotelInformationUrl'] }}" target="_blank" rel="noopener noreferrer">
                    <img src="{{ $hotels[$i]['hotel'][0]['hotelBasicInfo']['hotelThumbnailUrl'] }}" class="mx-auto my-0">
                    <p class="text-center">{{ $hotels[$i]['hotel'][0]['hotelBasicInfo']['hotelName'] }}<p>
                </a>
            </div>
        @endfor
    </div>
    <a class="my-0 mx-[10px] py-[3px] px-[8px] border border-gray-300 bg-inherit" onClick="history.back()">戻る</a>
</x-header>