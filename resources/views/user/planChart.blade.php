<x-header>
    <div style="flex-flow: column; display:flex; width:30%; justify-content: center; align-items: center;">
    <h3 style="color:green;">これからの旅行</h3>
        <div>
            @foreach($futurePlans as $futurePlan)
                <a href="{{ route('planChartDetails', $futurePlan['id']) }}">{{ $futurePlan['title'] }}</a><br>
            @endforeach
        </div>
    </div>
</x-header>