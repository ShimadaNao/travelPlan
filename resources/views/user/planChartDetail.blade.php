<x-header>
    <div class="detailTable">
        <div class="planChartTitle">
            <div class="planInfo">
                <p id="planTitle">{{ $plan['title'] }}</p>
                <p id="planDate">{{ $plan['startJ'] }}～{{ $plan['endJ'] }}</p>
            </div>
            @if (strtotime($today) <= strtotime($plan['end']))
            <button type="button" onclick="location.href='{{ route('deletePlan', $plan['id']) }}'"
            class="bg-transparent hover:bg-blue-500 text-blue-700 
            font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                削除
            </button>
            <button type="button" id="editBtn" onclick="location.href=''"
            class="bg-transparent hover:bg-blue-500 text-blue-700 
            font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                編集
            </button><br>
            @endif
            <a href="{{ route('showSelectedPlanMap', $plan['id']) }}">マップで見る</a>
        </div>
        @if($planDetail->isEmpty())
            <p>まだプランが登録されていません</p>
        @else
            <table class="table-auto planChartDetail">
                    <tr>
                        <th>日付</th>
                        <th>観光地名</th>
                        <th>予定時間</th>
                        <th>ひとこと</th>
                    </tr>
                    @foreach($planDetail as $detail)
                        <tr>
                            <td>{{ $detail['dayToVisit'] }}</td>
                            <td>{{ $detail['name'] }}</td>
                            <td>{{ substr($detail['timeToVisit'], 0, 5) }}</td>
                            <td>{{ $detail['comment'] }}</td>
                        <tr>
                    @endforeach
            </table>
            <div class="paginate">
                {{ $planDetail->links() }}
            </div>
        @endif
    </div>
    <script>
        window.planTitle = @json($plan['title']);
        window.planStart = @json($plan['start']);
        window.planEnd = @json($plan['end']);
        window.planId = @json($plan['id']);
    </script>
    <script src="{{ mix('js/planEdit.js') }}"></script>
</x-header>