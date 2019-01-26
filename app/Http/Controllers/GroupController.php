<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
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
        $this->middleware('role:group-admin', ['only' => ['showManageGroupAdmin']]);
        $this->middleware('permission:create-group', ['only' => ['createGroup']]);
        $this->middleware('permission:create-gun-modulator', ['only' => ['createGunModulator']]);
    }

    public function showManageGroup() 
    {
        return view('group.manage-group');
    }

    public function showManageGroupMember() 
    {
        $roles = Role::where('name','!=','super-admin')->get();
        return view('group.manage-group-member',compact('roles'));
    }

    /**
     * Creates a group
     *
     * @param Request $request
     * @return void
     */
    public function createGroup(Request $request)
    {
        $messages = [
            'group_admins.*.value.email' => 'Admin email is not valid.',
            'group_admins.*.value.unique' => 'Admin email is already taken.',
        ];
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255|unique:groups,name',
            'group_type' => 'required|string|max:255',
            'group_country' => 'required|numeric',
            'group_admins' => 'required|array',
            'group_admins.*.value' => 'email|unique:users,email'
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => implode(" ",$validator->messages()->all())
            ],200);
        }
        //if validator did not fail
        $group = Group::create([
            'name' => $request->group_name,
            'type' => $request->group_type,
            'country_id' => $request->group_country
        ]);
        //create group admins
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
    
    /**
     * Creates Group Members
     *
     * @param Request $request
     * @return JSON
     */
    public function createGroupMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_name' => 'required|string|max:255',
            'member_email' => 'required|email|unique:users,email',
            'member_role' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => implode(" ",$validator->messages()->all())
            ],200);
        }

        //create member 
        $member = User::create([
            'fullname' => $request->member_name,
                'email' => $request->member_email,
                'password' => bcrypt('meruem57'),//inproduction this should be a random generated string 
                'status' => 'active',
                'group_id' => $this->user->group->id
        ]);
        
        $member->assignRole($request->member_role);
        //in production send email to user to accept role and see password

        return response()->json([
            'type' => 'success',
            'message' => 'Member Created!'
        ],200);
    }
}
