<x-header>
    <div class="flex flex-col items-center text-center p-4">
        <p class="text-pink-400 p-8 text-2xl">旅行検索画面です</p>
        <form method="get" action="{{ route('planSearchResult') }}">
            <p>旅行Idを入力してください</p>
            <input type="text" name="plan_id" placeholder="旅行ID"><br>
            <p>キーワードを入力してください</p>
            <input type="text" name="keyword" planceholder="キーワード"><br>
            <input type="submit" value="検索する" class="mt-4">
        </form>
</x-header>