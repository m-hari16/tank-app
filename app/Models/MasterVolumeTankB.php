<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVolumeTankB extends Model
{
    use HasFactory;

    protected $table = 'm_tank_volume_201_204';

    protected $fillable = [
        'type_of_tank',
        'height',
        'vol',
    ];
}
