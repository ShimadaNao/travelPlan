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

    public function getInquiries()
    {
        $allInquiries = $this::all();

        return $allInquiries;
    }
}
