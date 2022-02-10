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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
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
            <div class="test" style="width:1380px;">
                <nav>
                    <ul class="navbar flex justify-center items-center">
                        @auth('users')
                            @if(isset($header))
                                {{ $header }}
                            @endif
                            <div id ="app">
                                <header class="container mx-auto text-teal-400 w-full relative">
                                    <div class="flex justify-between items-center w-full">
                                        <div>
                                            <button @click="isOpen = !isOpen" class="focus:outline-none relative">
                                                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                                    <path v-show="!isOpen" d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" fill="#FFDDFF" />
                                                    <path v-show="isOpen" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" fill="#FFDDFF"/>
                                                </svg>                       
                                            </button>
                                        </div>
                                    </div>
                                    <div :class="isOpen ? 'block hamburgerOpen' : 'hidden'" class="bg-rose-200 absolute w-[130px]">
                                        <ul class="items-center text-center text-[#FF6347]">
                                            <li class="border-b border-white md:border-none"><a href="#" class="block px-8 py-2 my-4 rounded md:font-medium">マイページ</a></li>
                                            <li class="border-b border-white md:border-none"><a href="#" class="block px-8 py-2 my-4 rounded md:font-medium">投稿</a></li>
                                            <li class="border-b border-white md:border-none"><a href="#" class="block px-8 py-2 my-4 rounded md:font-medium">お知らせ</a></li>
                                        </ul>
                                    </div>
                                </header>
                            </div>
                        @endauth
                        @guest
                        <li><a href="{{ route('multi_login') }}"  class="headerNav">ログイン</a></li>
                        <li><a href="{{ route('register') }}"  class="headerNav">新規登録</a></li>
                        @endguest
                        @auth('admins')
                        <li><a href="#"  class="headerNav">マップ</a></li>
                        <li><a href="{{ route('planSearchPage') }}"  class="headerNav">旅行検索</a></li>
                        <li><a href="/logout"  class="headerNav">ログアウト</a></li>
                        <li><a href="{{route('registerAdmin')}}"  class="headerNav">管理者登録</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    {{ $slot }}
    <script>
    const app = new Vue({
        el: "#app",
        data: {
            isOpen: false,
        },
    });
    </script>
</body>
</html>