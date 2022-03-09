<x-header>
{{-- $waiting $doneで出せるプルダウンで表示切替したい --}}
<select name="answeredOrNot">
    <option value="1" selected>未回答</option>
    <option value="0">回答済み</option>
</select>
<div class="inquiryArea" style="padding: 20px;">
    @foreach($waitings as $waiting)
    <ul>
    <a href="#">
        <li class="list-disc">
            ID：{{ $waiting['id'] }}
            タイトル：{{ $waiting['title'] }}<br>
        </li>
    </a>
    @endforeach
</div>
{{-- {{dd($waiting);}} --}}


</x-header>