<x-header>
    <p>旅行検索結果画面</p>
    @if ($plan_idResult)
    <p>Id検索結果</p>
    ・<a href="{{ route('planSearchResultDetail', $plan_idResult['id']) }}">{{ $plan_idResult['title'] }}</a>
    @endif
    @if ($keywordResults)
        <p>キーワード検索結果</p>
        {{ count($keywordResults) }}件該当しました。<br>
        @for ($i = 0; $i < count($keywordResults); $i++)
            ・{{$i + 1}}件目
            {{ $keywordResults[$i]['title']}}<br>
        @endfor
    @endif
    @if($plan_idResult == null && $keywordResults == null)
        <p>該当する計画はありませんでした</p>
    @endif
</x-header>