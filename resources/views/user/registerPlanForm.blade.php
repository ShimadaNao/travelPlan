<x-header>
    <div class="travelForm">
        <h3>旅行予定登録フォームです</h3>
        <form method="post" action="{{ route('registerTravelTitle') }}">
            @csrf
            旅行名：<input typw="text" name="title"><br>
            国名：
            <select name="country">
                @foreach($countries as $country)
                <option value="{{ $country['id'] }}">{{ $country['nameJP']}}</option>
                @endforeach
            </select><br>
            旅行開始日<input type="date" name="start"><br>
            旅行終了日：<input type="date" name="end"><br>
            <input type="submit" value="送信">
        </form>
    </div>
</x-header>