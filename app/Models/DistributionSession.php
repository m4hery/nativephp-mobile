<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DistributionSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'year',
        'is_active',
        'service_id',
        'created_by',
        'server_id',

    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'year' => 'integer',
    ];

    /******************************
     *** RELATIONSHIPS
     ******************************/


    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function distributions(): HasMany
    // {
    //     return $this->hasMany(Distribution::class, 'session_id');
    // }

    public function aidRequests(): HasMany
    {
        return $this->hasMany(AidRequest::class);
    }


}
