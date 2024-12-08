<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TankC extends Controller
{
    public function index(Request $req)
    {
        return view('page.tankC.form');
    }

    public function calculate(Request $req)
    {
        $sounding = $req->sounding;
        $pi = round(pi(), 2);
        $r = 116.7;
        $r2 = round(pow($r, 2), 2);

        $volume = round((float)($sounding * $pi * $r2), 2);

        $data = (object)[
            'phi' => $pi,
            'r' => $r,
            'r2' => $r2,
            'final_result' => $volume
        ];
        return response()->json(['data' => $data]);
    }
}
