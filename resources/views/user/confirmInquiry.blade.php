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
        <p>お問い合わせ確認画面です</p>
        <form method="post" action="{{ route('completeInquiry') }}">
            @csrf
            <ul  class="list-disc">
                <li>タイトル：{{ $inquiryContents['title'] }}</li>
                <li>お問い合わせ内容：{{ $inquiryContents['content'] }}</li>
            </ul>
            <div class="inquryCompleteBtn">
                <input type="submit" value="送信">
            </div>
            <input type="hidden" name="user_id" value="{{ $inquiryContents['user_id'] }}">
            <input type="hidden" name="genre_id" value="{{ $inquiryContents['genre_id'] }}">
            <input type="hidden" name="title" value="{{ $inquiryContents['title'] }}">
            <input type="hidden" name="content" value="{{ $inquiryContents['content'] }}">
        </form>
    </div>
</x-header>