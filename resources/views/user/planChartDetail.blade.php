<x-header>
    <div class="detailTable">
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