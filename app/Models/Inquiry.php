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
        return $this->hasOne(InquiryAnswer::class);
    }

    public function getInquiryDetail($id)
    {
        $inquiry = $this->where('id', $id)->with('user')->first();

        return $inquiry;
    }

    public function insertAnswerId($inquiry_id,$createdAnswer_id)
    {
        $inquiry = $this->where('id', $inquiry_id)->first();
        $inquiry->answer_id = $createdAnswer_id;
        $inquiry->save();
    }
}
