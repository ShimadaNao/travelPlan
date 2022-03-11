<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InquiryAnswer extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $table = 'inquiryAnswers';

    public function createAnswer($request)
    {
        $data = [
            'inquiry_id' => $request->inquiry_id,
            'answerer_id' => Auth::id(),
            'content' => $request->answer,
        ];
        $createdAnswer = $this->firstOrCreate($data);
        
        return $createdAnswer->id;
    }
}
