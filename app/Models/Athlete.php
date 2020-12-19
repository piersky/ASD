<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'photo',
        'date_of_birth',
        'birth_municipality',
        'birth_province',
        'birth_country',
        'phone',
        'email',
        'fiscal_code',
        'address',
        'municipality',
        'postal_code',
        'province',
        'country',
        'main_parent_id',
        'expiry_medical_certificate_at',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'begin_with_us_at',
        'end_with_us_at',
        'society_come_from',
        'deleted_at'
        ];
}
