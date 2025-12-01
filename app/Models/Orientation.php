<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orientation extends Model
{
     protected $fillable = [
        'name',
        'number_of_distribution',
        'server_id',
    ];

    /***********************
     * RELATIONSHIPS
     ***********************/
    public function aidRequests(): HasMany
    {
        return $this->hasMany(AidRequest::class);
    }
}
