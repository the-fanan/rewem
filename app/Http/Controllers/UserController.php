<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    /**
     * 
     */
    
    private $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function showDashboard()
    {
        return view('user.dashboard');
    }
    
}
