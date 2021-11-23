<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function register($data)
    {
        $adminRegistered = $this->firstOrCreate($data);
        if($adminRegistered->wasRecentlyCreated){
            $registerMsg = '新規管理者を登録しました';
        } else {
            $registerMsg = '管理者を登録できませんでした';
        }

        return $registerMsg;
    }
}
