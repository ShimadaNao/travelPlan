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
        $user_id = Auth::id();
        $selectedPlan = $planModel->getSelectedPlan($id);
        $countryLatLng = [
            'lat' => $selectedPlan['country']['lat'],
            'lng' => $selectedPlan['country']['lng'],
        ];

        return [$selectedPlan, $countryLatLng];
    }
}
