<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class MapController extends Controller
{
    public function __construct(Plan $plan)
    {
        $this->planModel = $plan;
    }

    public function showTopPage()
    {
        $places = [
            ['name' => 'フェヒョン駅', 'position' => [37.5586981,126.9784167]],
            ['name' => '新世界百貨店本店新館', 'position' => [37.5604860,126.9810507]],
            ['name' => '明洞駅', 'position' => [37.5608977,126.9863762]]
        ];

        return view('top', [
            'places' => $places,
        ]);
    }

    public function registerTravelTitle(Request $request)
    {
        $travelTitle = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'country_id' => $request->country,
            'from' => $request->from,
            'to' => $request->to,
        ];
        $travelTitleRegister = $this->planModel::firstOrCreate($travelTitle);
        $registeredId = $travelTitleRegister['id'];
        session()->flash('registeredMsg', '旅行計画を登録しました！');
        
        // return view('user.dashboard');
        return redirect()->route('showNowRegisteredPlan', ['id' => $registeredId]);
    }

    public function showNowRegisteredPlan($id)
    {
        $myPlans = $this->planModel->getPlans();
        $nowRegisteredPlan = $this->planModel->getNowRegisteredPlan($id); //新規登録された旅行タイトル
        $firstShowPlan = $nowRegisteredPlan;

        return view('user.showMyPlan', [
            'myPlans' => $myPlans,
            'nowRegisteredPlan' => $nowRegisteredPlan,
            'firstShowPlan' => $firstShowPlan,
        ]);
    }

    public function showMyPlan()
    {
        $myPlans = $this->planModel->getplans();
        $firstShowPlan = $this->planModel->getFirstPlan();

        return view('user.showMyPlan', [
            'myPlans' => $myPlans,
            'firstShowPlan' => $firstShowPlan,
        ]);
    }
}
