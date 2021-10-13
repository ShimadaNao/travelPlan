<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthController extends Controller
{
    public function __construct(Country $country, Plan $plan)
    {
        $this->countryModel = $country;
        $this->planModel = $plan;
    }
    public function showLoginForm()
    {
        return view('multi_auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $guard = $request->guard;

        if (\Auth::guard($guard)->attempt($credentials)) {
            return redirect($guard . '/dashboard');
        }

        return back()->withErrors([
            'auth' => ['認証に失敗しました']
        ]);
    }

    public function showUserDashboard()
    {
        $user_id = Auth::id();
        $userPlans = $this->planModel::where('user_id', $user_id)->get();
        // dd($userPlans);
        $countries = $this->countryModel::all();
        return view('user.dashboard', [
            'countries' => $countries,
            'userPlans' => $userPlans,
        ]);
    }

    public function showAdminDashboard()
    {
        return view('admin.dashboard');
    }
}
