<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    use HasFactory;

    protected $table = 'planDetails';

    protected $guarded = [
        'id'
    ];

    public function registerPlanDetail($planDetail)
    {
        $this->firstOrCreate($planDetail);
    }
}