<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User_answer extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'uk','other_uk','uk_qualification','other_uk_qualification','professional','other_professional','registered_with',
        'professional_pin','other_professional_pin','registration_number','aesthetic_training','aesthetic_training_date','aesthetic_treatment','insurance_company_name',
        'insurance_policy_number','prescribing_rights','other_aesthetic_training','other_prescribing_rights','identity',
        'address_proof','medical_qualification','aesthetic_training_certificate','insurance_certificate','other_certificate','rights_prescribe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
