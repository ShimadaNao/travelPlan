<x-header>
    <p class="flex justify-center">管理者登録確認画面です</p>
    <div class="flex justify-center">
    お名前：{{ $data['name'] }}<br>
    email：{{ $data['email'] }}<br>
    パスワード：{{ $data['password'] }}<br>
    </div>
    <form method="post" action="">
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="password" value="{{ $data['password'] }}">
        <div class="flex justify-center">
        <input type="submit" value="登録">
        </div>
    </form>
    </div>
</x-header>
