<x-header>
    <p class="flex justify-center">管理者登録画面です</p>
    <div class="flex justify-center">
    <form method="post" action="{{route('confirmAdminRegister')}}">
        @csrf
        管理者名:<input type="text" name="name"><br>
        email:<input type="email" name="email"><br>
        パスワード:<input type="password"><br>
        <div class="flex justify-center">
        <input type="submit" value="確認する">
        </div>
    </form>
    </div>
</x-header>