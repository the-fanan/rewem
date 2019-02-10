<?php

namespace rewem;

use Illuminate\Database\Eloquent\Model;
use rewem\User;

class AuditTrail extends Model
{
    //
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * For Relationships
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
