<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
     protected $fillable = [
        'distributor_id',
        'aid_request_id',
        'carnet_id',
        'facial_count',
        'village_id',
        'village_name',
        'status',
        'type',
        'coupon_amount',
        'coupon_quantity',
        'description',
        'date',
        'kind_of_kit',
        'session_id',
        'local_id',
        'is_sync',
        'server_id',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];
}
