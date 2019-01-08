<?php

namespace rewem;

use Illuminate\Database\Eloquent\Model;

class Gun extends Model
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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
