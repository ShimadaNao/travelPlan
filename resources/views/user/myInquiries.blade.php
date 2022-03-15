<x-header>
    <x-slot name="header">
        <li><a href="{{ route('userDashboard') }}" class="headerNav">マップ</a></li>
        <li><a href="{{ route('registerPlanForm') }}" class="headerNav">旅行計画登録フォーム</a></li>
        <li><a href="{{ route('planCharts') }}" class="headerNav">計画予定表</a></li>
        <li><a href="{{ route('calendar') }}" class="headerNav">カレンダー</a></li>
        <li><a href="{{ route('countryRanking') }}"  class="headerNav">人気国</a></li>
        <li><a href="/logout" class="headerNav">ログアウト</a></li>
    </x-slot>
    <div class="upsideCenter">
        <p>{{ Auth::user()->name }}様の問い合わせ一覧です</p>
        <ul class="list-disc" style="display: contents;">
            @foreach($myInquiries as $inquiry)
                <li class="modalOpen myInquiry">
                    ID；{{ $inquiry['id'] }}
                    <a class="inqTitle" onclick="showDetail({{ $inquiry['id'] }});" value="{{ $inquiry['id'] }}">タイトル：{{ $inquiry['title'] }}</a>
                </li>
                <div class="modaltest{{ $inquiry['id']}} inquiryModal"  style="background-color: #FFFFBB; width:30%; height:30%; display:none;">
                    <h3 class="content">問い合わせ内容：{{ $inquiry['content'] }}</h3>
                    @if($inquiry['answer_id'] != null)
                        <h3>回答：{{ $inquiry['inquiryAnswer']['content'] }}</h3>
                    @endif
                </div>
            @endforeach
        </ul>
    </div>
</x-header>
<script src="{{ mix('js/myInquiryDetail.js') }}"></script>