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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getPlans()
    {
        $user_id = Auth::id();
        $myPlans = $this->where('user_id', $user_id)->get();
        // $selectedPlan = $this->where('user_id', $user_id)
        //                     ->where('id', $id)->first();
        // return [$myPlans, $selectedPlan];
        return $myPlans;
    }

    public function getFirstPlan()
    {
        $user_id = Auth::id();
        $firstPlan = $this->where('user_id', $user_id)
                            ->with('country')
                            ->first();
        return $firstPlan;
    }

    public function getNowRegisteredPlan($id)
    {
        $user_id = Auth::id();
        $selectedPlan = $this->where('user_id', $user_id)
                                    ->where('id', $id)
                                    ->with('country')
                                    ->first();
        return $selectedPlan;
    }
}
