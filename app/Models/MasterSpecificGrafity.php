<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpecificGrafity extends Model
{
    use HasFactory;

    protected $table = 'm_specific_gravity';

    protected $fillable = [
        'type_of_tank',
        'item',
        'sg',
    ];
}
