<x-header>
    <div class="inquiryWrapper">
        <p>お問い合わせ詳細です</p>
        <div class="inquiryDetail" style="margin-bottom:5%;">
            <div>
                お問い合わせ者：{{ $inquiry['user']['name'] }}
            </div>
            <div>
                タイトル：{{ $inquiry['title'] }}
            </div>
            <div>
                お問い合わせ内容：{{ $inquiry['content'] }}
            </div>
        </div>
        <div class="inquriyAnswer"  style="text-align: center;">
            @if($inquiry['answer_id'] === null)
                <form method="post" action="{{ route('completeInquiry')}}">
                    @csrf
                    <div>お問い合わせ回答</div>
                        <textarea name="answer"></textarea>
                    <div>
                        <input type="hidden" name="inquiry_id" value="{{ $inquiry['id'] }}">
                        <input type="submit" value="送信する">
                    </div>
                </form>
            @else
                <div>回答</div>
                <div>{{ $inquiry['inquiryAnswer']['content'] }}</div>
            @endif
        </div>
    </div>
</x-header>