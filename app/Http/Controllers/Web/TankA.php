<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Enum\TypeOfTank;
use App\Models\MasterSpecificGrafity;
use App\Models\MasterTank;
use App\Models\MasterTankVolume;
use Illuminate\Http\Request;

class TankA extends Controller
{
    public function index()
    {
        $m_tank = MasterTank::where('type_of_tank', TypeOfTank::A)->orderBy('id', 'asc')->get();
        $m_sg = MasterSpecificGrafity::where('type_of_tank', TypeOfTank::A)->orderBy('id', 'asc')->get();

        return view('page.tankA.form', ['m_tank' => $m_tank, 'm_sg' => $m_sg]);
    }

    public function calculate(Request $req)
    {
        $volume = MasterTankVolume::where('type_of_tank', TypeOfTank::A)->where('height', '<=', (float)$req->sounding)->get()->last();
        
        $rumus = (float)(($volume->vol_up - $volume->vol_down) / 10);
        $selisih = (float)($req->sounding - $volume->height);
        $hasil = (float)(($rumus * $selisih) + $volume->vol_down);
        $final_result = (float)($hasil * (float)$req->sg);

        $data = (object)[
            'rumus' => $rumus,
            'selisih' => $selisih,
            'hasil' => $hasil,
            'final_result' => $final_result
        ];
        return response()->json(['data' => $data]);
    }
}
