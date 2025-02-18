<?php

namespace rewem;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
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
    public function group()
    {
        return $this->hasOne(Group::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
