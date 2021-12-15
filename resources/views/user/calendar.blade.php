<x-header>
    <div class="wrapper">
        <!-- xxxx年xx月を表示 -->
        <h1 id="header"></h1>
    
        <!-- ボタンクリックで月移動 -->
        <div id="next-prev-button">
            <button id="prev" onclick="prev()">‹</button>
            <button id="next" onclick="next()">›</button>
        </div>
    
        <!-- カレンダー -->
        <div id="calendar"></div>
        <script>
            window.myPlans = @json($myPlans);
        </script>
        <script src="{{ mix('js/calendar.js') }}"></script>
    </div>
</x-header>