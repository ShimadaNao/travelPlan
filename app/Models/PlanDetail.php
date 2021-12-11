<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PlanDetail extends Model
{
    use HasFactory;

    protected $table = 'planDetails';

    protected $guarded = [
        'id'
    ];

    public function registerPlanDetail($planDetail)
    {
        return $this->firstOrCreate($planDetail);
    }

    public function deleteDetail($id)
    {
        $planDetail = $this->find($id);
        $deletedPlan = $planDetail->delete();
        if($deletedPlan == 1) {
            $deleteMsg = 'プラン詳細を削除しました';
        } else {
            $deleteMsg = '削除失敗';
        }
        return [$planDetail, $deleteMsg];
    }

    public function getPlanDetail($id)
    {
        $a = $this->where('plan_id', $id)
                    ->orderby('dayToVisit', 'asc')
                    ->paginate(10);
        return $a;
    }
}
