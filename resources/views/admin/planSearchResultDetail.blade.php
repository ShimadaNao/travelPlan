<x-header>
    <p>検索結果詳細画面です</p>
    タイトル：{{ $planDetail['title'] }}<br>
    ユーザーID：{{ $planDetail['user_id'] }}<br>
    ユーザー名：{{ $planDetail['user']['name'] }}<br>
    開始日：{{ $planDetail['start'] }}<br>
    終了日：{{ $planDetail['end'] }}<br>
    <button style="background-color:burlywood; border-radius: 5px; " onclick="location.href='/admins/dashboard'">トップページへ</button>
</x-header>