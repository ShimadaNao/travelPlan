<?php

namespace App\Http\Controllers;

use App\Http\Requests\planSearchRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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

    public function showPlanSearchResult(planSearchRequest $request)
    {
        $data = [
            'plan_id' => $request->plan_id,
            'keyword' => $request->keyword,
        ];
        dd($data);
    }
}
