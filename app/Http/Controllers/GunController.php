<?php

namespace rewem\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use rewem\Group;
use rewem\User;
use rewem\Gun;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class GunController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            return $next($request);
        });
        $this->middleware('role:gun-creator', ['only' => ['showCreateGun']]);//except
        $this->middleware('permission:create-gun', ['only' => ['createGun']]);
    }

    public function showCreateGun()
    {
        return view('gun.create-gun');
    }

    public function createGun(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gun_serial_code' => 'required|string|max:255',
            'gun_model' => 'sometimes|nullable|string|max:255',
            'gun_type' => 'sometimes|nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => implode(" ",$validator->messages()->all())
            ],200);
        }
        //if validation is successfull
        $this->user->group->guns()->create([
            "serial_code" => $request->gun_serial_code,
            "model" => $request->gun_model,
            "type" => $request->gun_type,
        ]);

        return response()->json([
            'type' => 'success',
            'message' => 'Gun created!'
        ],200);
    }
}
