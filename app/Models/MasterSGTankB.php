<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSGTankB extends Model
{
    use HasFactory;

    protected $table = 'm_sg_201_204';

    protected $fillable = [
        'type_of_tank',
        'item',
        'temperature',
        'sg',
    ];
}
