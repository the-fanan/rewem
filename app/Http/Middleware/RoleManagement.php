<?php

namespace rewem\Http\Middleware;

use Closure;

class RoleManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $referer = $request->header('referer');
        if (!$request->user()->hasRole($role)) {
            $value = ucfirst(str_replace('-',' ',$role));
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'You can\'t access the page because you\'re not a ' . $value
                ],422);
            }
            if (empty($referer)) {
                return redirect(route('dashboard'))->with('error','Unauthorized action, you don\'t have the permission to access that page.');
            }
            return back()->with('error','Unauthorized action! You can\'t access the page because you\'re not a ' . $value);
        }
        return $next($request);
    }
}
