<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'old_data_label',
        'old_data_value',
        'new_data_label',
        'new_data_value',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
