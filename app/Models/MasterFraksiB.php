<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFraksiB extends Model
{
    use HasFactory;

    protected $table = 'm_fraksi_201_204';

    protected $fillable = [
        'type_of_tank',
        'ring_type',
        'height',
        'vol',
    ];
}
