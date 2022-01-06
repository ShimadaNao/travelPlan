<x-header>
    <div class="detailTable">
        <div class="planChartTitle">
            <p>{{ $plan['title'] }}</p>
            <p>{{ $plan['start'] }}～{{ $plan['end'] }}</p>
                <button type="button" onclick="location.href='{{ route('deletePlan', $plan['id']) }}'"
                class="bg-transparent hover:bg-blue-500 text-blue-700 
                font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    削除
                </button>
            <a href="">編集</a>
        </div>
        @if($planDetail->isEmpty())
            <p>まだプランが登録されていません</p>
        @else
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>観光地名</th>
                        <th>予定時間</th>
                        <th>ひとこと</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planDetail as $detail)
                        <tr>
                            <td>{{ $detail['dayToVisit'] }}</td>
                            <td>{{ $detail['name'] }}</td>
                            <td>{{ substr($detail['timeToVisit'], 0, 5) }}</td>
                            <td>{{ $detail['comment'] }}</td>
                        <tr>
                    @endforeach
                </tbody>
            </table>
            <div class="paginate">
                {{ $planDetail->links() }}
            </div>
        @endif
    </div>
</x-header>