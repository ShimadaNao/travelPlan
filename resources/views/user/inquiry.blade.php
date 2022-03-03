<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="inquiryWrapper">
        <p>お問い合わせフォームです</p>
        <form method="POST" action="" class="inquiryTable">
            <div class="inquiryForm">
                <label for="title">タイトル</label>
                <input type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="inquiryForm">
                <label foe="content">コンテンツ</label>
                <textarea name="content">{{ old('content') }}</textarea>
            </div>
            <input type="submit" value="送信">
        </form>
    </div>
</x-header>