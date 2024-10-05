<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\MasterFraksiB;
use App\Models\MasterSGTankB;
use App\Models\MasterVolumeTankB;
use Illuminate\Http\Request;

class TankB extends Controller
{
    public function index(Request $req)
    {
        $tank_id = $req->tank_identity;
        $item_tank = MasterSGTankB::where('type_of_tank', $tank_id)->first();

        return view('page.tankB.form', ['tank_id' => $tank_id, 'item_tank' => $item_tank]);
    }

    public function calculate(Request $req)
    {
        $tank_id = $req->type_of_tank;
        $selisih = $this->selisih($req->sounding);

        $minVol = $this->minimalVol($tank_id);

        $mainVol = MasterVolumeTankB::where('type_of_tank', $tank_id)->where('height', (float)$selisih->int)->first();

        $ringVol = 0;
        if ($selisih->decimal > 0) {
            $typeOfRing = $this->typeRing($selisih->int, $tank_id);
            $fraksi = MasterFraksiB::where('type_of_tank', $tank_id)->where('ring_type', $typeOfRing)->where('height', $selisih->decimal)->first();
            $ringVol = $fraksi->vol;
        }

        $sg = MasterSGTankB::where('type_of_tank', $tank_id)->where('temperature', $req->temperature)->first();

        $total = round((float)($minVol + $mainVol->vol + $ringVol), 2);
        $final_result = round((float)($total * $sg->sg), 2);

        $data = (object)[
            'min' => $minVol,
            'volume' => $mainVol->vol,
            'cincin' => $ringVol,
            'total' => $total,
            'sg' => $sg->sg,
            'final_result' => $final_result
        ];
        return response()->json(['data' => $data]);
    }

    public function minimalVol($tank_id) {
        $min = [
            "201" => 0,
            "202" => 0,
            "203" => 1717,
            "204" => 2314
        ];

        return $min[$tank_id];
    }

    public function selisih($number)
    {
        $int = floor($number);
        return (object)[
            "int" => $int,
            "decimal" => round(($number - $int), 1)
        ];
    }

    public function typeRing($height, $tank_id)
    {
        $tank = [
            "201" => [
                [16, 115, 1],
                [116, 260, 2],
                [261, 410, 3],
                [411, 560, 4],
                [561, 700, 5],
            ],
            "202" => [
                [18, 115, 1],
                [116, 260, 2],
                [261, 410, 3],
                [411, 560, 4],
                [561, 700, 5],
            ],
            "203" => [
                [5, 183, 1],
                [184, 365, 2],
                [366, 547, 3],
                [548, 700, 4]
            ],
            "204" => [
                [8, 183, 1],
                [184, 365, 2],
                [366, 547, 3],
                [548, 700, 4]
            ]
        ];

        foreach ($tank[$tank_id] as $range) {
            if ($height >= $range[0] && $height <= $range[1]) {
                return $range[2];
            }
        }
    }
}
