<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Structure extends Model
{
    protected $table = 'structures';
    protected $fillable = [
        'created_by',
        'name',
        'email',
        'phone',
        'address',
        'description',
        'max_aid_per_day',
        'server_id',
    ];

    /*****************
     * RELATIONSHIPS
     *****************/
    public function prescribers(): HasMany
    {
        return $this->hasMany(Prescriber::class);
    }

    public function aidRequests(): HasMany
    {
        return $this->hasMany(AidRequest::class);
    }

}
