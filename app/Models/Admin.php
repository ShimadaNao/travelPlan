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
        $adminRegistered = $this->firstOrCreate([
            'email' => $data['email']
        ], $data);
        if($adminRegistered->wasRecentlyCreated === true){
            $registerMsg = '新規管理者を登録しました';
            $registeredData = $adminRegistered;
        } else {
            $registerMsg = '管理者を登録できませんでした';
            $registeredData = null;
        }
        return [$registerMsg, $registeredData];
    }
}
