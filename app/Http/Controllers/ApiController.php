<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function showSelectedPlan(Plan $planModel, $id)
    {
        // dd(Auth::id());
        $user_id = Auth::id();
        $selectedPlan = $planModel->with('country')
                                ->where('user_id', $user_id)
                                ->where('id', $id)
                                ->first();
        $countryLatLng = [
            'lat' => $selectedPlan['country']['lat'],
            'lng' => $selectedPlan['country']['lng'],
        ];

        return [$selectedPlan, $countryLatLng];
    }
}
