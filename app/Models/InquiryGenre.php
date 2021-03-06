<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryGenre extends Model
{
    use HasFactory;

    protected $table = 'inquiryGenres';

    public function getGenres()
    {
        return $this->all();
    }
}
