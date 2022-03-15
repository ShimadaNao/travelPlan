<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('multi_login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="block">ユーザータイプ</label>
                <select name="guard" class="border rounded px-2 py-1 mb-5 w-full">
                    <option value="">選択してください</option>
                    <option value="users">一般ユーザー</option>
                    <option value="admins">管理者</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

{{-- 
<html>
<head>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <form method="POST" action="multi_login">
        @csrf
        <div class="p-3">
            @error('auth')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-3">
                &#x26A0; {{ $message }}
            </div>
            @enderror
            <label class="block">メールアドレス</label>
            <input class="border rounded mb-3 px-2 py-1" type="text" name="email">
            <label class="block">パスワード</label>
            <input class="border rounded mb-3 px-2 py-1" type="password" name="password">
            <label class="block">ユーザータイプ</label>
            <select name="guard" class="border rounded px-2 py-1 mb-5">
                <option value="">▼選択してください</option>
                <option value="users">一般ユーザー</option>
                <option value="admins">管理者</option>
            </select>
            <br>
            <button class="bg-blue-500 text-white rounded px-3 py-2" type="submit">ログイン</button>
        </div>
    </form>
</body>
</html> --}}