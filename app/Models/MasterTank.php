<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTank extends Model
{
    use HasFactory;

    protected $table = 'm_tank';

    protected $fillable = [
        'type_of_tank',
        'tank_identity_name',
    ];
}
