<?php

namespace App\Http\Controllers;

use App\Http\Requests\planRegisterRequest;
use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function __construct(Plan $plan, PlanDetail $planDetail)
    {
        $this->planModel = $plan;
        $this->planDetailModel = $planDetail;
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

    public function showPlanCharts()
    {
        $plans = $this->planModel->getPlans();
        $futurePlans = $plans[0];
        $pastPlans = $plans[1];
        return view('user.planChart', [
            'futurePlans' => $futurePlans,
            'pastPlans' => $pastPlans,
        ]);
    }

    public function showPlanChartDetails($id)
    {
        $plan = $this->planModel->getSelectedPlan($id);
        $planDetail = $this->planDetailModel->getPlanDetail($id);
        $detailCountryData = $plan['country'];

        $array_start= explode('-', $plan['start']);
        $array_end = explode('-', $plan['end']);
        $plan['start'] = $array_start[0].'年'.$array_start[1].'月'.$array_start[2].'日';
        $plan['end'] = $array_end[0].'年'.$array_end[1].'月'.$array_end[2].'日';

        return view('user.planChartDetail', [
            'plan' => $plan,
            'detailCountryData' => $detailCountryData,
            'planDetail' => $planDetail,
        ]);
    }

    public function showRegisterPlanForm(Country $country)
    {
        $countries = $country->getAll();
        return view('user.registerPlanForm', [
            'countries' => $countries,
        ]);
    }
}
