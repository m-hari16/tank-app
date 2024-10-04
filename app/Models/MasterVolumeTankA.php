<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVolumeTankA extends Model
{
    use HasFactory;

    protected $table = 'm_tank_volume_51_58';

    protected $fillable = [
        'type_of_tank',
        'height',
        'vol_up',
        'vol_down',
    ];
}
