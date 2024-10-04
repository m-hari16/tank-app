<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSGTankA extends Model
{
    use HasFactory;

    protected $table = 'm_sg_51_58';

    protected $fillable = [
        'type_of_tank',
        'item',
        'sg',
    ];
}
