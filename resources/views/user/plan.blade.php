<x-header>
    [$futurePlans, $pastPlans, $today];
    <h3>これからの旅行</h3>
    @foreach($futurePlans as $futurePlan)
        <a href="">{{ $futurePlan['title'] }}</a><br>
    @endforeach
</x-header>