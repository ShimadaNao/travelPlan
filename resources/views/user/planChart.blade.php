<x-header>
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