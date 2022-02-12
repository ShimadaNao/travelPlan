<x-header>
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
    <div class="paginate">
        {{ $sharedPlans->links() }}
    </div>
</x-header>