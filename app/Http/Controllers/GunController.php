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
        $this->middleware('role:gun-controller', ['only' => ['showControlGun']]);//except
        $this->middleware('role:gun-creator', ['only' => ['showCreateGun']]);//except
        $this->middleware('permission:create-gun', ['only' => ['createGun']]);
        $this->middleware('permission:control-gun', ['only' => ['controlGun']]);
    }

    public function showCreateGun()
    {
        return view('gun.create-gun');
    }

    public function showControlGun()
    {
        return view('gun.control-gun');
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
        $gun = $this->user->group->guns()->create([
            "serial_code" => $request->gun_serial_code,
            "model" => $request->gun_model,
            "type" => $request->gun_type,
        ]);
        //add audit trail
        $this->user->auditTrails()->create([
            "group_id" => $this->user->group_id,
            "action" => "Created",
            "object" => $gun->id,
            "object_type" => get_class($gun),
            "details" => json_encode($gun)
        ]);
        

        return response()->json([
            'type' => 'success',
            'message' => 'Gun created!'
        ],200);
    }

    public function updateGun(Request $request)
    {
        $validator = Validator::make($request->gun_details, [
            'serial_code' => 'required|string|max:255',
            'model' => 'sometimes|nullable|string|max:255',
            'type' => 'sometimes|nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => implode(" ",$validator->messages()->all())
            ],200);
        }

        //if validation does not fial update gun
        $gun = Gun::find($request->gun_details['id']);
        $gun->update($request->gun_details);
        //add audit trail
        $this->user->auditTrails()->create([
            "group_id" => $this->user->group_id,
            "action" => "Edited",
            "object" => $gun->id,
            "object_type" => get_class($gun),
            "details" => json_encode($gun)
        ]);
        return response()->json([
            'type' => 'success',
            'message' => "Gun " . $request->gun_details['serial_code'] . " updated"
        ],200);
    }

    public function searchGuns(Request $request)
    {
        if ($request->search == "") {
            $members = $this->user->group->guns;
            return response()->json($members,200);
        }
        $members = $this->user->group->guns()->where('serial_code', 'like', '%' . $request->search . '%')->orWhere('model', 'like', '%' . $request->search . '%')->orWhere('type', 'like', '%' . $request->search . '%')->get();
        return response()->json($members,200);
    }

    public function getGunParameters(Request $request)
    {
        $gun = Gun::find($request->id);
        return $gun;
    }
}
