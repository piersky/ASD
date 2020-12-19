<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'lang_id',
        'name',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
