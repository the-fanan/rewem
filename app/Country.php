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
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function guns()
    {
        return $this->hasMany(Gun::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
