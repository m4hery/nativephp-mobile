<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescriber extends Model
{

    protected $fillable = [
        'structure_id',
        'firstname',
        'lastname',
        'login',
        'token',
        'email',
        'phone',
        'email_verified_at',
        'register_ip',
        'password',
        'history',
        'forget_token',
        'active_token',
        'active',
        'address',
        'aboutme',
        'last_connection',
        'city',
        'postalcode',
        'avatar',
        'is_prescriber',
        'service_id',
        'is_prescriber_referral',
        'is_accepted_condition',
        'status',
        'server_id',
    ];


    protected $casts = [
        'otp_enabled' => 'boolean',
    ];


    /*****************
     * RELATIONSHIPS
     *****************/
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

}
