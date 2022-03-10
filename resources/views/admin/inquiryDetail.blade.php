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
            <form method="post" action="">
                <div>お問い合わせ回答</div>
                    <textarea name="answer"></textarea>
                <div>
                    <input type="submit" value="送信する">
                </div>
            </form>
        </div>
    </div>
</x-header>