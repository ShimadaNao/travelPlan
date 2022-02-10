<x-header>
    <div class="searchResultWrapper">
        <h1 class="planSearchResultTitle">検索結果詳細画面です</h1>
        <div class="resultDetailTable">
            <div class="detailTableRow">
                <label class="detailTableItem">タイトル：</label>
                <label class="detailTableItem">{{ $planDetail['title'] }}</label>
            </div>
            <div class="detailTableRow">
                <label class="detailTableItem">ユーザーID：</label>
                <label class="detailTableItem">{{ $planDetail['user_id'] }}</label>
            </div>
            <div class="detailTableRow">
                <label class="detailTableItem">ユーザー名：</label>
                <label class="detailTableItem">{{ $planDetail['user']['name'] }}</label>
            </div>
            <div class="detailTableRow">
                <label class="detailTableItem">開始日：</label>
                <label class="detailTableItem">{{ $planDetail['start'] }}</label>
            </div>
            <div class="detailTableRow">
                <label class="detailTableItem">終了日：</label>
                <label class="detailTableItem">{{ $planDetail['end'] }}</label>
            </div>
        </div> 
        <button class="detailTableBtn" onclick="location.href='/admins/dashboard'">トップページへ</button>
    </div>
</x-header>