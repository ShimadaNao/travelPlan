<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use App\Models\PlanDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\planRegisterRequest;
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

    public function updatePlan(planRegisterRequest $request)
    {
        $plan_id = $request->plan_id;
        $updateContents = [
            'title' => $request['title'],
            'start' => $request['start'],
            'end' => $request['end'],
        ];
        $updatedData = $this->planModel->updatePlan($plan_id, $updateContents);
        if($updatedData>= 1){
            $msg = '更新しました';
        } else {
            $msg = '更新できませんでした';
        }

        return $msg;
    }

    //追加
    public function confirmExcludablePlanDetails(Request $request)
    {
        $plan_id = $request->plan_id;
        $updateData = [
            'plan_id' => $plan_id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ];
        $excludablePlanDetails = $this->planModel->getExcludablePlanDetails($plan_id, $updateData);
        return $excludablePlanDetails;
    }

    public function searchHotel()
    {
        $url = 'https://app.rakuten.co.jp/services/api/Travel/GetAreaClass/20131024?applicationId=1067456968266429394&format=json';

        $raw_data = file_get_contents($url);
        $data = json_decode($raw_data, true);
        $cityData = $data['areaClasses']['largeClasses'][0]['largeClass'][1]['middleClasses'];

        return view('user.searchHotel', [
                'cityData' => $cityData
            ]);
    }

    public function searchThroughApi(Request $request)
    {
        $data = [
            'pref' => $request->prefecture,
            'city' => $request->city,
            'people' => $request->people,
        ];
        // フォームのリクエストで入力されたかセッション情報からに日付を取得したかで分岐
        if($request->start) {
            $start = $request->start;
            $end = $request->end;
        } else {
            $start = session('start');
            $end = session('end');
        }
        $url = 'https://app.rakuten.co.jp/services/api/Travel/VacantHotelSearch/20170426?applicationId=1067456968266429394&format=json&largeClassCode=japan&middleClassCode='.
        $data['pref'].'&smallClassCode='.$data['city'].'&checkinDate='.$start.'&checkoutDate='.$end.'&adultNum='.$data['people'];

        $contents = @file_get_contents($url);
        $data = json_decode($contents, true);

        return view('user.searchHotels.showVacantHotels', [
            'hotels' => $data['hotels']
        ]);
    }
}