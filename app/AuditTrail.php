<?php

namespace rewem;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    //
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $protected = [
        'id'
    ];

    /**
     * For Relationships
     */
}
