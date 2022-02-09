<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function planDetail()
    {
        return $this->hasMany(PlanDetail::class);
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
        $today = Carbon::today('Asia/Tokyo')->toDateString();
        //旅行最終日が今日以降のもの(最終日が今日だったら$futurePlansに含まれる)
        $futurePlans = $this->where('user_id', $user_id)
                            ->whereDate('end', '>=', $today)
                            ->with('planDetail')
                            ->get();
        //旅行最終日が昨日以前のもの
        $pastPlans = $this->where('user_id', $user_id)
                            ->whereDate('end', '<', $today)
                            ->with('planDetail')
                            ->get();

        return [$futurePlans, $pastPlans, $today];
    }

    public function getFirstPlan()
    {
        $user_id = Auth::id();
        $today = Carbon::today('Asia/Tokyo')->toDateString();
        $firstPlan = $this->where('user_id', $user_id)
                            ->whereDate('end', '>=', $today)
                            ->with('country')
                            ->with('planDetail')
                            ->first();
        return $firstPlan;
    }

    public function getSelectedPlan($id)
    {
        $user_id = Auth::id();
        $selectedPlan = $this->where('id', $id)
                        ->with('country')
                        ->with('planDetail')
                        ->first();
        return $selectedPlan;
    }

    public function getMyAllPlans()
    {
        $user_id = Auth::id();
        //日付順に取得
        $myAllPlans = $this->where('user_id', $user_id)
                            ->orderBy('start', 'asc')->get();

        return $myAllPlans;
    }

    public function deleteTravelPlan($id)
    {
        $result = $this->where('id', $id)->delete();
        if($result>0){
            $deleteMsg = '旅行日程を削除しました。';
        } else {
            $deleteMsg = '旅行日程を削除できませんでした。';
        }
        
        return $deleteMsg;
    }

    public function updatePlan($plan_id, $updateContents)
    {
        return $this->where('id', $plan_id)->update($updateContents);
    }

    public function getPopularCountryRanking()
    {
        $ranking = $this->select(DB::raw('count(country_id) AS country_count, country_id'))
                            ->groupBy('country_id')
                            ->orderBy('country_count', 'DESC')
                            ->with('country')
                            ->take(20)
                            ->get();
        $denominator = 0;
        foreach($ranking as $plan) {
            $denominator += $plan['country_count'];
        }

        return [$ranking, $denominator];
    }

    public function getExcludablePlanDetails($id, $updateData)
    {
        $planInfo = $this->where('id', $id)->with('planDetail')->first();
        $planDetails = $planInfo['planDetail'];
        $newStartDate = new DateTime($updateData['start']);
        $newEndDate = new DateTime($updateData['end']);
        $excludables = array();
        foreach ($planDetails as $detail) {
            $visitDate = new DateTime($detail['dayToVisit']);
            if ($visitDate < $newStartDate || $visitDate > $newEndDate) {
                $excludables[] = $detail;
            }
        }
        return $excludables;
    }

    public function getSearchResults($request)
    {
        $plan_id = $request->plan_id;
        $keyword = $request->keyword;
        $plan_idResult = $this->where('id', $plan_id)->first();
        $keywordResults = null;//エラー回避のためundefinedの
        if ($keyword != null) {
            $keywordResults = $this->where('title', 'like', '%'.$keyword.'%')->get();
        }
        // $results = [
        //     'plan_idResult' => $this->where('id', $plan_id)->first(),
        //     'keywordResult' => $this->where('title', 'like', '%'.$keyword.'%')->get(),
        // ];
        return [
            'plan_idResult' => $plan_idResult,
            'keywordResults' => $keywordResults
        ];
        // dd($keywordResult);

    }
}
