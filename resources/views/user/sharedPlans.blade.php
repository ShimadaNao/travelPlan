<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div style="display: flex; justify-content: space-around; flex-wrap:wrap; text-align:center;">
        @foreach($sharedCountries as $key =>$country)
            <a href="{{ route('itsSharedPlan', $key) }}" style="width:30%; margin: 2% 0 1% 0">{{ $country }}</a>
        @endforeach
    </div>
</x-header>