<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerPlan($request)
    {
        $travelTitle = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'country_id' => $request->country,
            'start' => $request->start,
            'end' => $request->end,
            'public' => $request->public,
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
                        ->with('user')
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
        $keywordResults = [];//エラー回避のためundefinedの
        if ($keyword != null) {
            $keywordResults = $this->where('title', 'like', '%'.$keyword.'%')->get();
        }
        
        return [
            'plan_idResult' => $plan_idResult,
            'keywordResults' => $keywordResults
        ];
    }
    // 公開計画をただtableとして全部表示するver 一旦コメントアウト
    // public function getSharedPlans()
    // {
    //     $sharedPlans = $this->where('public', 'yes')->with('user')->with('country')->paginate(2);
    //     foreach($sharedPlans as $plan){
    //         $array_start = explode('-', $plan['start']);
    //         $plan['start'] = $array_start[0].'年'.$array_start[1].'月'.$array_start[2].'日'; //2022年03月01日
    //         $array_end = explode('-', $plan['end']);
    //         $plan['end'] = $array_end[0].'年'.$array_end[1].'月'.$array_end[2].'日';
    //     }
    //     return $sharedPlans;
    // }
    // 公開計画を一覧画面で国別に選べるver
    public function getSharedPlans()
    {
        $sharedPlans = $this->where('public', 'yes')
            ->with('user')
            ->with('country')
            ->with('planDetail')
            ->get();

        // リレーション先のplanDetailでorderByかsortByできるか考える
        // foreach($sharedPlans as $plan){
        //     foreach($plan['planDetail'] as $detail){
        //         // dd($detail['dayToVisit']);
        //         $sortedDetail = $detail['dayToVisit']->sortBy();
        //         dd($sortedDetail);
        //     }
        // }
        // $a= $sharedPlans[3]['planDetail']->sortBy('dayToVisit');
        // dd($a);

        // $sharedPlans = Plan::select('*')
        // ->from('plans')
        // ->join('planDetails', 'plans.id', '=', 'planDetails.plan_id')
        // ->where('public', 'yes')
        // ->orderBy('planDetails.dayToVisit', 'asc')->get();
        // dd($sharedPlans);

        session()->forget('sessionShared');
        session()->put('sessionShared', $sharedPlans);
        // dd(session()->get('sessionShared'));
        $countryNames = []; //公開旅行の国名変数
        // foreach($sharedPlans as $plan){
        //     $countryNames[] = $plan['country']['nameJP'];
        // }
        // $uniqueCountryNames = array_unique($countryNames);

        // in_array関数で$countryNamesになかったら追加していく
        foreach($sharedPlans as $plan){
            if(!(in_array($plan['country']['nameJP'], $countryNames))){
                $countryNames[$plan->country_id] = $plan['country']['nameJP'];
            }
        }

        return [
            'sharedPlans' => $sharedPlans,
            'countryNames' => $countryNames,
        ];
    }

    public function getItsSharedPlans($id)
    {
        $result = session()->get('sessionShared');
        // dd($result);
        $thisPlans = [];//クリックされた国の公開旅行計画を入れる変数
        //$thisPlans = $result['sharedPlans']->where('country_id', $id);
        $thisPlans = $result->filter(function($plan) use($id) {
            return  $plan->country_id === (int)$id;
        })->values();
        // dd($thisPlans);
        // dd($thisPlans->paginate(1));
        return $thisPlans;
    }
}
