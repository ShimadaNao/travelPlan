<x-header>
    {{-- {{dd($ranking);}} --}}
    <div class="ranking" {{-- style="margin: 50px;"--}}> 
        <p>旅行先人気ランキング</p>
        <dl>
        <ul class="list-disc">
            @for($i = 0; $i<count($ranking); $i++)
            <li><label class="country">{{ $i+1 }}位 {{ $ranking[$i]['country']['nameJP']}}</label>
                <span class="country_count">{{$ranking[$i]['country_count']}}件</span>
                <div class="percentage">({{ floor($ranking[$i]['country_count']/ $denominator * 100) }}％)</div>
            </li>
            @endfor
        </ul>
        </dl>
    </div>
</x-header>