<x-header>
    <p class="flex justify-center adminRegisterP">管理者登録確認画面です</p>
    <div class="justifyCenter my-12">
    <ul>
        <li>
            <label for="name" class="inputLabel">お名前：</label>
            {{ $data['name'] }}
        </li>
        <li>
            <label for="email" class="inputLabel">email：</label>
            {{ $data['email'] }}
        </li>
        <li><label for="password" class="inputLabel">パスワード：</label>
        {{ $data['password'] }}
    </li>
    </ul>
    </div>
    <form method="post" action="{{route('completeAdminRegister')}}">
        @csrf
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="password" value="{{ $data['password'] }}">
        <div class="flex justify-center">
        <input type="submit" value="登録">
        </div>
    </form>
    </div>
</x-header>
