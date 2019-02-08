<?php

namespace rewem;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use rewem\Gun;
use rewem\Group;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /* All the fields present on this array will be automatically accessible in your views with Carbon functions
    *
    * @var array
    */
   protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'group_id'
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
     * Mutators
    */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
     }
 
    /**
     ============ For Relationships =============
     */
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     ============= For frontend functions ========
     */

     public function profilePicture()
     {
         return $this->profile_image ?? 'dist/img/avatar.png';
     }

     public function sidebarLinks()
     {
         $links = [];

         if ($this->hasPermissionTo('create-group')) {
            $link = ["title" => "Manage Groups", "href" => "group.manage.show", "icon" => "fa-group"];
            $links[] = $link;
         }

         if ($this->hasPermissionTo('manage-group-members')) {
            $link = ["title" => "Manage Group Members", "href" => "group-member.manage.show", "icon" => "fa-user"];
            $links[] = $link;
         }

         if ($this->hasPermissionTo('create-gun')) {
            $link = ["title" => "Create Gun", "href" => "gun.create.show", "icon" => "fa-play"];
            $links[] = $link;
         }

         if ($this->hasPermissionTo('control-gun')) {
            $link = ["title" => "Control Gun", "href" => "gun.control.show", "icon" => "fa-circle"];
            $links[] = $link;
         }


         return $links;
     }

     public function dashboardTabs()
     {
         $tabs = [];
         
         if ($this->hasRole('super-admin')) {
            $tabs[] = ["title" => "groups", "icon" => "fa-group", "bg-color" => "bg-aqua", "quantity" => Group::all()->count()];
            $tabs[] = ["title" => "guns", "icon" => "fa-th", "bg-color" => "bg-aqua", "quantity" => Gun::all()->count()];
         }

         if ($this->hasRole('group-admin')) {
    
            $tabs[] = ["title" => "gun controllers", "icon" => "fa-group", "bg-color" => "bg-aqua", "quantity" => $this->group->users()->with('roles')->whereHas("roles", function($q){ $q->where("name", "gun-controller"); })->count()];

            $tabs[] = ["title" => "gun creators", "icon" => "fa-group", "bg-color" => "bg-aqua", "quantity" => $this->group->users()->with('roles')->whereHas("roles", function($q){ $q->where("name", "gun-creator"); })->count()];

            $tabs[] = ["title" => "group admins", "icon" => "fa-group", "bg-color" => "bg-aqua", "quantity" => $this->group->users()->with('roles')->whereHas("roles", function($q){ $q->where("name", "group-admin"); })->count()];

            $tabs[] = ["title" => "gun users", "icon" => "fa-group", "bg-color" => "bg-aqua", "quantity" => $this->group->users()->with('roles')->whereHas("roles", function($q){ $q->where("name", "gun-user"); })->count()];

         }
        
         return $tabs;
     }
}
