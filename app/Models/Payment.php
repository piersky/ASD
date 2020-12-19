<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'year',
        'payment_date',
        'athlete_id',
        'amount',
        'period',
        'method',
        'note',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
