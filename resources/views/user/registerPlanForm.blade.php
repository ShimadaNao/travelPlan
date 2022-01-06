<x-header>
    <div class="travelForm">
        <p>旅行予定登録フォームです</p>
        <form method="post" action="{{ route('registerTravelTitle') }}">
            @csrf
            @if($errors->has('title'))
                @foreach($errors->get('title') as $error)
                    <p style="color:orangered">{{ $error }}<p>
                @endforeach
            @endif
            旅行名：<input type="text" name="title"><br>

            @if($errors->has('country'))
            @foreach($errors->get('country') as $error)
                <p style="color:orangered">{{ $error }}<p>
            @endforeach
            @endif
            国名：
            <select name="country">
                @foreach($countries as $country)
                <option value="{{ $country['id'] }}">{{ $country['nameJP']}}</option>
                @endforeach
            </select><br>

            @if($errors->has('start'))
            @foreach($errors->get('start') as $error)
                <p style="color:orangered">{{ $error }}<p>
            @endforeach
            @endif
            旅行開始日：<input type="date" name="start"><br>

            @if($errors->has('end'))
            @foreach($errors->get('end') as $error)
                <p style="color:orangered">{{ $error }}<p>
            @endforeach
            @endif
            旅行終了日：<input type="date" name="end"><br>
            <input type="submit" value="送信">
        </form>
    </div>
</x-header>