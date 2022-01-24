<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav ">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav selec">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    
    <div class="ranking" {{-- style="margin: 50px;"--}}> 
        <p>旅行先人気ランキング</p>
        <dl>
        <ul class="list-disc">
            @for($i = 0; $i<count($ranking); $i++)
            <li><label class="country">{{ $i+1 }}位 {{ $ranking[$i]['country']['nameJP']}}</label>
                <span class="country_count">{{$ranking[$i]['country_count']}}件</span>
                <div class="percentage">({{ floor($ranking[$i]['country_count']/ $denominator * 100) }}％)</div>
            </li>
            @endfor
        </ul>
        </dl>
    </div>
</x-header>