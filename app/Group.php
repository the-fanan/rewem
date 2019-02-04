<?php

namespace rewem;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'country_id',
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
