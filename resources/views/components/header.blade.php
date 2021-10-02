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
</head>
<body>
    <div class="bg-indigo-200">
        <header class="flex flex-col items-center container mx-auto text-grey">
            <h1 class="flex justify-center">
                <a href="/" class="title">{{ config('app.name', 'Laravel') }}</a>
            </h1>
                <nav>
                <ul class="flex justify-center">
                    @guest
                    <li><a href="{{ route('multi_login') }}"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">ログイン</a></li>
                    <li><a href="{{ route('register') }}"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">新規登録</a></li>
                    @endguest
                    <li><a href="#"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">マップ</a></li>
                    <li><a href="#"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">ショップ</a></li>
                    <li><a href="#"  class="block px-8 py-2 my-4 hover:bg-indigo-300 rounded">お問い合わせ</a></li>
                </ul>
                </nav>
        </header>
    </div>
    {{ $slot }}
</body>
</html>