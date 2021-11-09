<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="/css/app.css" rel="stylesheet">
    @if(isset($leafletCss))
    {{ $leafletCss }}
    {{ $leafletJavaScript }}
    {{ $addressPlugin }}
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
    <div class="bg-indigo-200">
        <header class="flex flex-col items-center container mx-auto text-grey">
            <h1 class="flex justify-center">
                @auth('users')
                    <a href="{{ route('userDashboard') }}" class="title">{{ config('app.name', 'Laravel') }}</a>
                @endauth
                @auth('admins')
                    <a href="{{ route('adminDashboard') }}" class="title">{{ config('app.name', 'Laravel') }}</a>
                @endauth
                @guest
                    <a href="/" class="title">{{ config('app.name', 'Laravel') }}</a>
                @endguest
            </h1>
                <nav>
                <ul class="flex justify-center">
                    @guest
                    <li><a href="{{ route('multi_login') }}"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">ログイン</a></li>
                    <li><a href="{{ route('register') }}"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">新規登録</a></li>
                    @endguest
                    <li><a href="#"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">マップ</a></li>
                    <li><a href="#"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">ショップ</a></li>
                    <li><a href="/logout"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">ログアウト</a></li>
                </ul>
                </nav>
        </header>
    </div>
    {{ $slot }}
</body>
</html>