<?php

namespace rewem;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * For Relationships
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    /**
     * 
     */
    /*
    private $user;
    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
        /*
        $this->middleware('role:Agent')->except('becomeLpm');
        $this->middleware('permission:admin-management');
        $this->middleware('permission:add-admin',['only' => 'store']);
        $this->middleware('permission:update-admin',['only' => ['edit','update','changePassword']]);
        $this->middleware('permission:delete-admin',['only' => 'destroy']);*/
    }*/
}
