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
    public function __construct(Plan $planModel, PlanDetail $planDetailModel)
    {   
        $this->planModel = $planModel;
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
        $nowRegisteredId = $registeredPlanDetail->id;
        $nowRegisteredInfo = $this->planDetailModel->find($nowRegisteredId);
        $registeredPlanMsg = '登録しました';
        return [$registeredPlanMsg, $nowRegisteredInfo];
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

    public function updatePlanDetail(Request $request)
    {   
        $planDetail_id = $request->planDetail_id;
        $data = [
            'name' => $request->planDetailName,
        ];
        if(isset($request->date)){
            $data['dayToVisit'] = $request->date;
        }
        if(isset($request->time)){
            $data['timeToVisit'] = $request->time;
        }
        //コメントがあったらそれを追加、コメントがない若しくは空だったらnullを代入
        if(isset($request->comment)){
            $data['comment'] = $request->comment;
        } else {
            $data['comment'] = null;
        }
        $updatedPlanDetail = $this->planDetailModel->where('id', $planDetail_id)->update($data);
        if ($updatedPlanDetail >= 1) {
            $updateMsg = '更新しました';
        } else {
            $updateMsg = '更新できませんでした';
        }
        $updatedData = $this->planDetailModel->where('id', $planDetail_id)->first();

        return [$updateMsg, $updatedData];
    }

    public function showCalendar()
    {
        $myPlans = $this->planModel->getMyAllPlans();

        return view('user.calendar', [
            'myPlans' => $myPlans,
        ]);
    }
}
