<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    public $table = "parents";

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'fiscal_code',
        'address',
        'postal_code',
        'municipality',
        'province',
        'country',
        'mobile',
        'phone',
        'email',
        'conjugality',
        'partner_id',
        'wants_tax_certificate',
        'is_active',
        'updated_by',
        'created_by'
    ];
}
