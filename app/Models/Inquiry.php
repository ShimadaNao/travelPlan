<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\InquiryService;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiryGenre()
    {
        return $this->belongsTo(InquiryGenre::class);
    }

    public function inquiryAnswer()
    {
        return $this->hasOne(inquiryAnswer::class);
    }

    // public function __construct(InquiryService $inquiryService)
    // {
    //     $this->inquiryService = $inquiryService;
    // }

    public function completeInquiry($request)
    {
        // この辺の処理はサービスに移してよさそう
        $this->inquiryService = app()->make(InquiryService::class);
        $data = $this->inquiryService->getInquiryForm($request);
        // dd($data);
        $result = Inquiry::firstOrCreate($data);
        if($result->wasRecentlyCreated)
        {
            return $message = 'お問い合わせを受け付けました';
        }else {
            return $message = 'お問い合わせを受け付けられませんでした。再度お試し下さい。';
        }
    }
}
