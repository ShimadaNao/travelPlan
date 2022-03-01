<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="sharedPlansList">
        <p>公開旅行計画一覧画面です</p>
        <table>
            <tr>
                <th class="border px-4 py-2">旅行地</th>
                <th class="border px-4 py-2">ユーザー名</th>
                <th class="border px-4 py-2">日程</th>
            </tr>
            @foreach($sharedPlans as $plan)
            <tr>
                <td class="border px-4 py-2">{{ $plan['country']['nameJP'] }}</td>
                <td class="border px-4 py-2">{{ $plan['user']['name'] }}</td>
                <td class="border px-4 py-2">{{ $plan['start'] }}～{{ $plan['end'] }}</td>
            </tr>
            @endforeach
        </table>
        <div class="paginate flex">
            {{ $sharedPlans->links() }}
        </div>
    </div>
</x-header>