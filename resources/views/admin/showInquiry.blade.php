<x-header>
{{-- $waiting $doneで出せるプルダウンで表示切替したい --}}
<div class="inquiryWrapper">
    @if(session('msg'))
    {{ session('msg') }}<br>
    @endif
    <select name="answeredOrNot" id="select_box">
        <option value="1">未回答</option>
        <option value="0">回答済み</option>
    </select>
    <div class="inquiryArea" style="padding: 20px;">
        <div class="waiting">
            @foreach($waitings as $waiting)
            <ul>
                <li class="list-disc">
                    <a href="{{ route('inquiryDetail', $waiting['id']) }}">
                    ID：{{ $waiting['id'] }}
                    タイトル：{{ $waiting['title'] }}
                    </a><br>
                </li>
            @endforeach
        </div>
        <div class="done" style="display:none;">
            @foreach($dones as $done)
            <ul>
                <li class="list-disc">
                    <a href="{{ route('inquiryDetail', $done['id']) }}">
                    ID：{{ $done['id'] }}
                    タイトル：{{ $done['title'] }}
                    </a><br>
                </li>
            @endforeach
        </div>
    </div>
</div>
</x-header>
<script>
    window.waitings = @json($waitings);
    window.dones = @json($dones);
</script>
<script src="{{ mix('js/inquiryStatus.js') }}"></script>