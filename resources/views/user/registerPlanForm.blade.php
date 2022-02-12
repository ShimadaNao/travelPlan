<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav selec">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>

    <div class="travelForm">
        {{-- {{dd($reg);}} --}}
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
                    <td class="registerPlanForm"><input type="text" name="title" value="{{ old('title') }}"></td>
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
                    <td class="registerPlanForm"><input type="date" name="start" value="{{ old('start') }}"></td>
                </tr>
                <tr>
                    @if($errors->has('end'))
                        @foreach($errors->get('end') as $error)
                            <p style="color:orangered; font-size:20px">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">旅行終了日：</th>
                    <td class="registerPlanForm"><input type="date" name="end" value="{{ old('end') }}"></td>
                </tr>
                <tr>
                    @if($errors->has('public'))
                        @foreach($errors->get('public') as $error)
                            <p style="color:orangered; font-size:20px">{{ $error }}<p>
                        @endforeach
                    @endif
                    <th class="registerPlanForm">公開設定：</th>
                    <td class="registerPlanForm public">
                        <div>
                            <input type="radio" name="public" value="yes">公開
                        </div>
                        <div>
                            <input type="radio" name="public" value="no">非公開
                        </div>
                    </td>
                </tr>
            </table>
            <div class="registerPlanBtn">
                <input type="submit" value="送信">
            </div>
        </form>
    </div>
</x-header>