<x-header>
    <div class="detailTable">
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
                @foreach($planDetailInfo as $detail)
                    <tr>
                        <td>{{ $detail['dayToVisit'] }}</td>
                        <td>{{ $detail['name'] }}</td>
                        <td>{{ substr($detail['timeToVisit'], 0, 5) }}</td>
                        <td>{{ $detail['comment'] }}</td>
                    <tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-header>