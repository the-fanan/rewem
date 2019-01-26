<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Auth;
use rewem\Group;
use rewem\User;


class GroupController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
        $this->middleware('role:super-admin', ['only' => ['showManageGroup']]);//except
        $this->middleware('permission:create-group', ['only' => ['createGroup']]);
    }

    public function showManageGroup() 
    {
        return view('group.manage-group');
    }

    public function showManageGroupAdmin() 
    {
        return view('group.manage-group-admin');
    }

    public function createGroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255|unique:groups,name',
            'group_type' => 'required|string|max:255',
            'group_country' => 'required|numeric',
            'group_admins' => 'required|array',
            'group_admins.*.value' => 'email|unique:users,email'
        ]);
        if ($validator->fails()) {
            //write code to parse valdator->errors() into human readable form
           /* $message = "";
            foreach((array) $validator->errors() as $error => $value) {
                //$error = field name $value = field value 
                if (!is_array($value)) {
                    $message += $message . $value . " ";
                }
            }*/
            return response()->json([
                'type' => 'error',
                'message' => $validator->errors()
            ],200);
        }
        //if validator did not fail
        $group = Group::create([
            'name' => $request->group_name,
            'type' => $request->group_type,
            'country_id' => $request->group_country
        ]);
        //Parse group admins
        DB::beginTransaction();
        foreach ($request->group_admins as $index => $value) {
            $admin = User::create([
                'fullname' => 'Admin ' . $index,
                'email' => $value['value'],
                'password' => bcrypt('meruem57'),//inproduction this should be a random generated string 
                'status' => 'active',
                'group_id' => $group->id
            ]);
            $admin->assignRole('group-admin');
            //in production send mail to adnmin containing password
        }
        DB::commit();
        return response()->json([
            'type' => 'success',
            'message' => 'Group Created!'
        ],200);
    }
}
