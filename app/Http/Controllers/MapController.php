<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showTopPage()
    {
        $places = [
            ['name' => 'フェヒョン駅', 'position' => [37.5586981,126.9784167]],
            ['name' => '新世界百貨店本店新館', 'position' => [37.5604860,126.9810507]],
            ['name' => '明洞駅', 'position' => [37.5608977,126.9863762]]
        ];

        return view('top', [
            'places' => $places,
        ]);
    }
}
