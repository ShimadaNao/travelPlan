<x-header>
    <div class="adminRegisterCompleted">
    <p>{{ $registerMsg }}</p>
    @if($registeredData !== null)
        <p>登録情報</p>
        管理者：{{ $registeredData['name'] }}<br>
        email：{{ $registeredData['email'] }}<br>
    @endif
    <a href="{{route('adminDashboard')}}">トップページへ</a>
    </div>
</x-header>