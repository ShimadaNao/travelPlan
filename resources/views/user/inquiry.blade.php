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
        <form method="POST" action="{{ route('confirmInquiry') }}" class="inquiryTable">
            @csrf
            <div class="inquiryForm">
                <label for="genre">問い合わせジャンル</label>
                <select name="genre_id">
                    @foreach($inquiryGenres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['about'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="inquiryForm">
                <label for="title">タイトル</label>
                @if( $errors->has('title') )
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $errors->first('title') }}</span>
                </div>
                @endif
                <input type="text" name="title" value="{{ old('title') }}">
            </div>
            <div class="inquiryForm">
                <label for="content">お問い合わせ内容</label>
                @if($errors->has('content'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $errors->first('content') }}</span>
                    </div>
                @endif
                <textarea name="content">{{ old('content') }}</textarea>
            </div>
            <input type="submit" value="送信">
        </form>
    </div>
</x-header>