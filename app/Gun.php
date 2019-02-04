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
    protected $guarded = [
        'id'
    ];

    /**
     * For Relationships
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
