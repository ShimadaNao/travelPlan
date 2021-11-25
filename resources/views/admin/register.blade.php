<x-header>
    <p class="flex justify-center">管理者登録画面です</p>
    <div class="flex justify-center">
    <form method="post" action="{{route('confirmAdminRegister')}}">
        @csrf
        @if($errors->has('name'))
            @foreach($errors->get('name') as $message)
            <div class="text-red-600">
                <li>{{ $message }}</li>
            </div>
            @endforeach
        @endif
        管理者名:<input type="text" name="name"><br>
        @if($errors->has('email'))
            @foreach($errors->get('email') as $message)
            <div class="text-red-600">
                <li>{{ $message }}</li>
            </div>
            @endforeach
        @endif
        email:<input type="email" name="email"><br>
        @if($errors->has('password'))
            @foreach($errors->get('password') as $message)
            <div class="text-red-600">
                <li>{{ $message }}</li>
            </div>
            @endforeach
        @endif
        パスワード:<input type="password" name="password"><br>
        <div class="flex justify-center">
        <input type="submit" value="確認する">
        </div>
    </form>
    </div>
</x-header>