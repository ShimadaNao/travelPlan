<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav selec">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="wrapper" style="text-align: center;">
        <!-- xxxx年xx月を表示 -->
        <h1 id="header"></h1>
    
        <!-- ボタンクリックで月移動 -->
        <div id="next-prev-button">
            <button id="prev" onclick="prev()">‹</button>
            <button id="next" onclick="next()">›</button>
        </div>
    
        <!-- カレンダー -->
        <div id="calendar"  style="text-align: center;"></div>
        <script>
            window.myPlans = @json($myPlans);
        </script>
        <button id="button">スケジュールを表示</button>
        <script src="{{ mix('js/calendar.js') }}"></script>
    </div>
</x-header>