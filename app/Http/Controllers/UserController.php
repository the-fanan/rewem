<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * 
     */
    
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
    }
}
