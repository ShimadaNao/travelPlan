<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function __construct()
    {
        $this->today = Carbon::today('Asia/Tokyo')->toDateString();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function registerPlan($request)
    {
        $travelTitle = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'country_id' => $request->country,
            'start' => $request->start,
            'end' => $request->end,
        ];
        $travelTitleRegister = $this::firstOrCreate($travelTitle);

        return $travelTitleRegister;
    }

    public function getPlans()
    {
        $user_id = Auth::id();
        $today = $this->today;
        //旅行最終日が今日以降のもの(最終日が今日だったら$futurePlansに含まれる)
        $futurePlans = $this->where('user_id', $user_id)
                            ->whereDate('end', '>=', $today)
                            ->get();
        //旅行最終日が昨日以前のもの
        $pastPlans = $this->where('user_id', $user_id)
                            ->whereDate('end', '<', $today)
                            ->get();

        return [$futurePlans, $pastPlans, $today];
    }

    public function getFirstPlan()
    {
        $user_id = Auth::id();
        $today = $this->today;
        $firstPlan = $this->where('user_id', $user_id)
                            ->whereDate('end', '>=', $today)
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
