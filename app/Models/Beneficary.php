<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Beneficary extends Model
{
      use HasFactory, SoftDeletes;

    const GENDER_HOMME = "Homme" ;
    const GENDER_FEMME = "Femme" ;
    const GENDER_MADAME = "Madame" ;
    const GENDER_MONSIEUR = "Monsieur" ;
    const GENDER_NEUTRE = "Neutre" ;

    const SITUATION_CELIBATAIRE = "Célibataire" ;
    const SITUATION_COUPLE = "Couple" ;
    const SITUATION_VEUF = "Veuf";
    const SITUATION_VEUVE = "Veuve";
    const SITUATION_UNION_LIBRE = 'Union libre';

    const SITUATION_MARIE = "Marié" ;
    const SITUATION_MARIEE = "Mariée" ;
    const SITUATION_DIVORCE = "Divorcé" ;
    const SITUATION_DIVORCEE = "Divorcée" ;

    protected $casts = [
        'birthday' => 'date:Y-m-d',
    ];

    protected $table = 'beneficiaries';

    protected $fillable = [
        'is_archive_emsp',
        'created_by',
        'firstname',
        'lastname',
        'birthday',
        'gender',
        'phone',
        'family_situation',
        'unborn_child',
        'address',
        'activity',
        'monthly_income',
        'rest_live_income',
        'zipcode',
        'old',
        'ciu',
        'village_id',
        'job',
        'service_id',
        'is_sync',
        'is_new',
        'comment',
        'is_urgent',
        'hasChildren',
        'numberOfChildren',
        'otherAidDistributed',
        'is_normal',
        'local_id',
        'server_id',
    ];
}
