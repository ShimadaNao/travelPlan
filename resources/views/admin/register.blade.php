<x-header>
    <p class="adminRegisterP">管理者登録画面です</p>
    <div class="adminRegisterForm">
    <form method="post" action="{{route('confirmAdminRegister')}}">
        <input type="hidden" name="_token">
        <ul>
            @if($errors->has('name'))
                @foreach($errors->get('name') as $message)
                <div class="text-red-600">
                    <li>{{ $message }}</li>
                </div>
                @endforeach
            @endif
            <li>
                <label for="name">管理者名:</label>
                <input type="text" id="name" name="name"><br>
            </li>
            @if($errors->has('email'))
                @foreach($errors->get('email') as $message)
                <div class="text-red-600">
                    <li>{{ $message }}</li>
                </div>
                @endforeach
            @endif
            <li>
                <label for="email">email:</label>
                <input type="email" id="email" name="email"><br>
            </li>
            @if($errors->has('password'))
                @foreach($errors->get('password') as $message)
                <div class="text-red-600">
                    <li>{{ $message }}</li>
                </div>
                @endforeach
            @endif
            <li>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password"><br>
            </li>
            <input type="submit" value="確認する">
        </ul>
    </form>
    </div>
    <div class="pwCheck">
        <form class="pwForm">
            @csrf
            パスワードを入力してください<br>
            <input type="password" name="password"><br>
            <input type="button" value="送信" onclick="pwCheckPost()">
        </form>
    </div>
    @if(app('env') == 'production')
        <script src="{{ secure_asset('js/adminPwCheck.js') }}"></script>
    @else
        <script src="{{ asset('js/adminPwCheck.js') }}"></script>
    @endif
    {{-- <script src="{{ asset('js/adminPwCheck.js') }}"></script> --}}
</x-header>