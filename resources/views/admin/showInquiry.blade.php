<x-header>
{{-- $waiting $doneで出せるプルダウンで表示切替したい --}}
<select name="answeredOrNot">
    <option value="1" selected>未回答</option>
    <option value="0">回答済み</option>
</select>
<div class="inquiryArea" style="padding: 20px;">
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
{{-- {{dd($waiting);}} --}}


</x-header>