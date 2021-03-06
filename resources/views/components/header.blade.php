<html lang="ja" style="width: 100%;">
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
            <h1 class="appTitle">
                @auth('users')
                    <a href="{{ route('userDashboard') }}" class="title">{{ config('app.name', 'Laravel') }}</a>
                    <div>ユーザーとしてログイン中</div>
                @endauth
                @auth('admins')
                    <a href="{{ route('adminDashboard') }}" class="title">{{ config('app.name', 'Laravel') }}</a>
                    <div>管理者としてログイン中</div>
                @endauth
                @guest
                    <a href="/" class="title">{{ config('app.name', 'Laravel') }}</a>
                @endguest
            </h1>
            <div class="test" style="width:1380px;">
                <nav>
                    <ul class="navbar flex justify-center items-center">
                        @auth('users')
                            @if(isset($header))
                                {{ $header }}
                            @endif
                            <div id="app">
                                <hamburgermenu-component></hamburgermenu-component>
                            </div>
                        @endauth
                        @guest
                            <li><a href="{{ route('multi_login') }}"  class="headerNav">ログイン</a></li>
                            <li><a href="{{ route('register') }}"  class="headerNav">新規登録</a></li>
                        @endguest
                        @auth('admins')
                            <li><a href="{{ route('planSearchPage') }}"  class="headerNav">旅行検索</a></li>
                            <li><a href="{{ route('showInquiries') }}"  class="headerNav">問い合わせ確認</a></li>
                            <li><a href="{{route('registerAdmin')}}"  class="headerNav">管理者登録</a></li>
                            <li><a href="/logout"  class="headerNav">ログアウト</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    {{ $slot }}
    {{-- <script>
    const app = new Vue({
        el: "#menu",
        data: {
            isOpen: false,
        },
    });
    </script> --}}
    <script src="{{ mix('js/header.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>