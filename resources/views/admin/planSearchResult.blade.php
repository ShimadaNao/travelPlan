<x-header>
    <p class="planSearchResultTitle">旅行検索結果画面</p>
    <div class="searchResultWrapper">
        @if ($plan_idResult)
        <p>ID検索結果</p>
        <div class="searchResultItem">・<a href="{{ route('planSearchResultDetail', $plan_idResult['id']) }}">{{ $plan_idResult['title'] }}</a></div>
        @endif
        @if ($keywordResults)
            <p>キーワード検索結果<span>({{ count($keywordResults) }}件該当)</span></p>
            {{-- {{ count($keywordResults) }}件該当しました。<br> --}}
            @for ($i = 0; $i < count($keywordResults); $i++)
            <div class="searchResultItem">
                ・{{$i + 1}}件目
                <a href="{{ route('planSearchResultDetail', $keywordResults[$i]['id']) }}">{{ $keywordResults[$i]['title']}}</a><br>
            </div>
            @endfor
        @endif
        @if($plan_idResult == null && $keywordResults == null)
            <p>該当する計画はありませんでした</p>
        @endif
    </div>
</x-header>