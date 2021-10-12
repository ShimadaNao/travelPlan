<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function getPlans()
    {
        $user_id = Auth::id();
        $myPlans = $this->where('user_id', $user_id)->get();
        return ['myplans'];
    }
}
