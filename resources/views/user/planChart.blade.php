<x-header>
    <div style="display: flex; justify-content: space-around; margin: 0 20%;">{{-- このdivに justify-content: space-around;で子要素のjustfy-contentをなくしても良いかも --}}
        <div style="flex-flow: column; text-align: center;">
        <h3 style="color:green;">これからの旅行</h3>
            <div>
                @foreach($futurePlans as $futurePlan)
                    <a href="{{ route('planChartDetails', $futurePlan['id']) }}">{{ $futurePlan['title'] }}</a><br>
                @endforeach
            </div>
        </div>
        <div style="flex-flow: column; text-align: center;">
            <h3 style="color: green">過去の旅行</h3>
            <div>
                @foreach($pastPlans as $pastPlan)
                    <a href="{{ route('planChartDetails', $pastPlan['id']) }}">{{ $pastPlan['title'] }}</a><br>
                @endforeach
            </div>
        </div>
    </div>
</x-header>