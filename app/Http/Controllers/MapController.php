<?php

namespace App\Http\Controllers;

use App\Http\Requests\planRegisterRequest;
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

    public function registerTravelTitle(planRegisterRequest $request)
    {
        $travelTitleRegister = $this->planModel->registerPlan($request);
        $registeredId = $travelTitleRegister['id'];
        session()->flash('registeredMsg', '旅行計画を登録しました！');

        return redirect()->route('showNowRegisteredPlan', ['id' => $registeredId]);
    }

    public function showNowRegisteredPlan($id)
    {
        // $myPlans = $this->planModel->getPlans();
        $plans = $this->planModel->getPlans();
        $futurePlans = $plans[0];
        $pastPlans = $plans[1];
        $nowRegisteredPlan = $this->planModel->getSelectedPlan($id); //新規登録された旅行タイトル
        $firstShowPlan = $nowRegisteredPlan;

        return view('user.showMyPlan', [
            'futurePlans' => $futurePlans,
            'pastPlans' => $pastPlans,
            'nowRegisteredPlan' => $nowRegisteredPlan,
            'firstShowPlan' => $firstShowPlan,
        ]);
    }

    public function showMyPlan()
    {
        // $myPlans = $this->planModel->getPlans();
        $plans = $this->planModel->getPlans();
        $futurePlans = $plans[0];
        $pastPlans = $plans[1];

        $firstShowPlan = $this->planModel->getFirstPlan();

        return view('user.showMyPlan', [
            'futurePlans' => $futurePlans,
            'pastPlans' => $pastPlans,
            'firstShowPlan' => $firstShowPlan,
        ]);
    }

    public function showPlanPage()
    {
        $plans = $this->planModel->getPlans();
        $futurePlans = $plans[0];
        $pastPlans = $plans[1];
        return view('user.plan', [
            'futurePlans' => $futurePlans,
            'pastPlans' => $pastPlans,
        ]);
    }
}
