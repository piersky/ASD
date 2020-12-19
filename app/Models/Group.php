<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
