<?php

namespace App\Http\Controllers;

use App\Http\Requests\inquiryRequest;
use App\Http\Requests\planSearchRequest;
use App\Services\InquiryService;
use App\Models\Admin;
use App\Models\Inquiry;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct (Plan $plan)
    {
        $this->planModel = $plan;
    }

    public function reAuth(Request $request, Admin $admin)
    {
        $csrf_token = $request['_token'];
        $admin_id = Auth::id();
        $adminData = $admin->find($admin_id);
        $getPw = $request['password'];
        $result = Hash::check($getPw, $adminData['password']);
        if($result == true){
            $reAuthResult = $csrf_token;
        } else {
            $reAuthResult = '認証に失敗しました';
        }

        return $reAuthResult;
    }

    public function showPlanSearchResult(Plan $plan, planSearchRequest $request)
    {
        $results = $plan->getSearchResults($request);

        return view('admin.planSearchResult', [
            'plan_idResult' => $results['plan_idResult'],
            'keywordResults' => $results['keywordResults'],
        ]);
    }
    
    public function showPlanSearchResultDetail($id)
    {
        $planDetail = $this->planModel->getSelectedPlan($id);

        return view('admin.planSearchResultDetail', [
            'planDetail' => $planDetail,
        ]);
    }

    public function showInquiries(inquiry $inquiry, InquiryService $inquiryService)
    {
        $inquiries = $inquiryService->sortInquiries();

        return view('admin.showInquiry', [
            'waitings' => $inquiries['waitings'],
            'dones' => $inquiries['dones'],
        ]);
    }
}
