<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct(PlanDetail $planDetailModel)
    {
        $this->planDetailModel = $planDetailModel;
    }
    public function showSelectedPlan(Plan $planModel, $id)
    {
        $user_id = Auth::id();
        $selectedPlan = $planModel->getSelectedPlan($id);
        $countryLatLng = [
            'lat' => $selectedPlan['country']['lat'],
            'lng' => $selectedPlan['country']['lng'],
        ];

        return [$selectedPlan, $countryLatLng];
    }

    public function registerPlanDetail(Request $request)
    {
        $planDetail = [
            'name' => $request->name,
            'plan_id' => $request->plan_id,
            'latitude' => $request->lat,
            'longitude' => $request->lng,
        ];
        if (isset($request->dayToVisit)) {
            $planDetail['dayToVisit'] = $request->dayToVisit;
        }
        if (isset($request->timeToVisit)) {
            $planDetail['timeToVisit'] = $request->timeToVisit;
        }
        if (isset($request->comment)) {
            $planDetail['comment'] = $request->comment;
        }
        $registeredPlanDetail = $this->planDetailModel->registerPlanDetail($planDetail);
        // $registeredPlanDetailId = $registeredPlanDetail->id;
        $registeredPlanMsg = '登録しました';
        return $registeredPlanMsg;
    }

    public function deletePlanDetail($id)
    {
        // $deleteResult = $this->planDetailModel->deleteDetail($id);
        $result = $this->planDetailModel->deleteDetail($id);
        $deletedContent = [
            'planDetail' => $result[0],
            'deletedResult' => $result[1],
        ];
        $planDetail = $result[0];
        $deleteResult = $result[1];
        // return $deleteResult;
        return $deletedContent;
    }
}
