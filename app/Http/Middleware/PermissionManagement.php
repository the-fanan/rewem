<?php

namespace rewem\Http\Middleware;

use Closure;

class PermissionManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!$request->user()->hasPermissionTo($permission)) {
            $value = ucfirst(str_replace('-',' ',$permission));
            if ($request->ajax()) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Unauthorized action, you don\'t have the permission to ' . $value
                ],200);
            }
            

            return back()->with('error','Unauthorized action, you don\'t have the permission to ' . $value);
        }
        return $next($request);
    }
}
