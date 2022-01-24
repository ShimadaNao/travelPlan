<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav selec">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>

    <p class="planDeleteMsg">{{ session('result') }}<p>
        <p style="text-align:center; color:crimson;">これからの旅行のみ編集・削除ができます！</p>
    <div class="planChart-wrapper">
        <div class="planChart-body">
            <div style="flex-flow: column; text-align: center;">
            <h3>これからの旅行</h3>
                <div>
                    @foreach($futurePlans as $futurePlan)
                        <a href="{{ route('planChartDetails', $futurePlan['id']) }}">{{ $futurePlan['title'] }}</a><br>
                    @endforeach
                </div>
            </div>
            <div style="flex-flow: column; text-align: center;">
                <h3>過去の旅行</h3>
                <div>
                    @foreach($pastPlans as $pastPlan)
                        <a href="{{ route('planChartDetails', $pastPlan['id']) }}">{{ $pastPlan['title'] }}</a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-header>