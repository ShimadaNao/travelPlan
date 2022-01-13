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
                @if(Auth::user())
                    {{Auth::user()->name}}
                @else
                <p>未ログインです</p>
                @endif
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
                    @auth('users')
                    <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
                    <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
                    <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
                    <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
                    <li><a href="/logout" class="headerNav">ログアウト</a></li>
                    @endauth
                    @guest
                    <li><a href="{{ route('multi_login') }}"  class="headerNav">ログイン</a></li>
                    <li><a href="{{ route('register') }}"  class="headerNav">新規登録</a></li>
                    @endguest
                    @auth('admins')
                    <li><a href="#"  class="headerNav">マップ</a></li>
                    <li><a href="#"  class="headerNav">ショップ</a></li>
                    <li><a href="/logout"  class="headerNav">ログアウト</a></li>
                    <li><a href="{{route('registerAdmin')}}"  class="headerNav">管理者登録</a></li>
                    @endauth
                </ul>
                </nav>
        </header>
    </div>
    {{ $slot }}
</body>
</html>