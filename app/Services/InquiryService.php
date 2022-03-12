<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Inquiry;

class InquiryService
{
    // public function __construct(Inquiry $inquiry)
    // {
    //     $this->inquiryModel = $inquiry;
    // }

    public function getInquiryForm($request)
    {
        $data = [
            'user_id' => Auth::id(),
            'genre_id' => $request->genre_id,
            'title' => $request->title,
            'content' => $request->content,
        ];

        return $data;
    }

    public function completeInquiry($request)
    {
        $data = $this->getInquiryForm($request);
        $result = Inquiry::firstOrCreate($data);
        if($result->wasRecentlyCreated)
        {
            return $message = 'お問い合わせを受け付けました';
        }else {
            return $message = 'お問い合わせを受け付けられませんでした。再度お試し下さい。';
        }
    }

    public static function sortInquiries()
    {
        $allInquiries = Inquiry::with(['user', 'inquiryAnswer'])->get();
        $waitings = [];
        $dones = [];
        foreach($allInquiries as $inquiry) {
            if($inquiry['answer_id'] == null) {
                $waitings[] = $inquiry;
            } else {
                $dones[] = $inquiry;
            }
        }

        return [
            'waitings' => $waitings,
            'dones' => $dones,
        ];
    }
}

?>