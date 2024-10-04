<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Enum\TypeOfTank;
use App\Models\MasterSGTankA;
use App\Models\MasterTank;
use App\Models\MasterVolumeTankA;
use Illuminate\Http\Request;

class TankA extends Controller
{
    public function index()
    {
        $m_tank = MasterTank::where('type_of_tank', TypeOfTank::A)->orderBy('id', 'asc')->get();
        $m_sg = MasterSGTankA::where('type_of_tank', TypeOfTank::A)->orderBy('id', 'asc')->get();

        return view('page.tankA.form', ['m_tank' => $m_tank, 'm_sg' => $m_sg]);
    }

    public function calculate(Request $req)
    {
        $volume = MasterVolumeTankA::where('type_of_tank', TypeOfTank::A)->where('height', '<=', (float)$req->sounding)->get()->last();

        $rumus = round((float)(($volume->vol_up - $volume->vol_down) / 10), 2);
        $selisih = round((float)($req->sounding - $volume->height), 2);
        $hasil = round((float)(($rumus * $selisih) + $volume->vol_down), 2);
        $final_result = round((float)($hasil * (float)$req->sg), 2);

        $data = (object)[
            'rumus' => $rumus,
            'selisih' => $selisih,
            'hasil' => $hasil,
            'final_result' => $final_result
        ];
        return response()->json(['data' => $data]);
    }
}
