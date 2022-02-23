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
        <p>{{ $countryName }}の公開旅行計画一覧画面です</p>
        <div class="position" style="width: 50%; height: 50%; display:none;">
        </div>
        <table>
            <tr>
                {{-- <th class="border px-4 py-2">旅行地</th> --}}
                <th class="border px-4 py-2">旅行タイトル</th>
                <th class="border px-4 py-2">ユーザー名</th>
                <th class="border px-4 py-2">日程</th>
            </tr>
            @for($i = 0; $i < count($sharedPlans) && $i <30; $i++)
            <tr>
                {{-- $sharedPlans[$i]['id']でその旅行計画が取得できる --}}
                {{-- <td class="border px-4 py-2">{{ $plan['country']['nameJP'] }}</td> --}}
                <td class="border px-4 py-2 btn" onclick="show({{$i}})">{{ $sharedPlans[$i]['title'] }}</td>
                <td class="border px-4 py-2">{{ $sharedPlans[$i]['user']['name'] }}</td>
                <td class="border px-4 py-2">{{ $sharedPlans[$i]['start'] }}～{{ $sharedPlans[$i]['end'] }}</td>
            </tr>
            @endfor
        </table>
        {{-- <div class="paginate flex">
            {{ $sharedPlans->links() }}
        </div> --}}
    </div>

    <script>
        // window.sharedPlans = @json($sharedPlans);

        // const sharedPlans = @json($sharedPlans);
        // console.log(sharedPlans);
        // function show(i){
        //     console.log(i);
        // }
        window.planDetail = @json($sharedPlans);
    </script>
        <script src="{{ mix('js/sharedPlan.js') }}"></script>
</x-header>