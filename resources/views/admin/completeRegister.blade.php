<x-header>
    <div class="adminRegisterCompleted">
    <h3 class="adminRegisterP">{{ $registerMsg }}</h3>
    @if($registeredData !== null)
        <p class="adminRegisteredArea">登録情報</p>
        <ul class="mb-10">
            <li>
                <label class="inputLabel">管理者：</label>{{ $registeredData['name'] }}
            </li>
            <li>
                <label class="inputLabel">email：</label>{{ $registeredData['email'] }}
            </li>
        </ul>
    @endif
    <a href="{{route('adminDashboard')}}">トップページへ</a>
    </div>
</x-header>