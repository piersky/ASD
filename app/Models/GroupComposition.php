<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupComposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'athlete_id',
        'group_id',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

}
