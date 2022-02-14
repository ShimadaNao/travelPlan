<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <table>
        <tr>
            <th>旅行地</th>
            <th>ユーザー名</th>
            <th>日程</th>
        </tr>
        @foreach($sharedPlans as $plan)
        <tr>
            <td>{{ $plan['country']['nameJP'] }}</td>
            <td>{{ $plan['user']['name'] }}</td>
            <td>{{ $plan['start'] }}～{{ $plan['end'] }}</td>
        </tr>
        @endforeach
    </table>
    <div class="flex">
        {{ $sharedPlans->links() }}
    </div>
</x-header>