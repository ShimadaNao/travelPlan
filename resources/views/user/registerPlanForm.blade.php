<x-header>
    <div class="travelForm">
        <p>旅行予定登録フォームです</p>
        <form method="post" action="{{ route('registerTravelTitle') }}">
            @csrf
            <table>
                <tr>
                    @if($errors->has('title'))
                        @foreach($errors->get('title') as $error)
                            <p style="color:orangered; font-size:20px;">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">旅行名：</th>
                    <td class="registerPlanForm"><input type="text" name="title"></td>
                </tr>

                <tr>
                    @if($errors->has('country'))
                        @foreach($errors->get('country') as $error)
                            <p style="color:orangered; font-size:20px;">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">国名：</th>
                    <td class="registerPlanForm">
                    <select name="country">
                        @foreach($countries as $country)
                        <option value="{{ $country['id'] }}">{{ $country['nameJP']}}</option>
                        @endforeach
                    </select>
                    </td>
                </tr>

                <tr>
                    @if($errors->has('start'))
                        @foreach($errors->get('start') as $error)
                            <p style="color:orangered; font-size:20px;">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">旅行開始日：</th>
                    <td class="registerPlanForm"><input type="date" name="start"></td>
                </tr>

                <tr>
                    @if($errors->has('end'))
                        @foreach($errors->get('end') as $error)
                            <p style="color:orangered; font-size:20px">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">旅行終了日：</th>
                    <td class="registerPlanForm"><input type="date" name="end"></td>
                </tr>
                <tr>
                    <td class="registerPlanForm btn"><input type="submit" value="送信"></td>
                </tr>
            </table>
        </form>
    </div>
</x-header>