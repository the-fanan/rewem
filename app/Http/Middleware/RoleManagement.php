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
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'You can\'t access the page because you\'re not a ' . ucfirst($role)
                ],422);
            }
            if (empty($referer)) {
                return redirect(route('welcome'))->with('error','Unauthorized action, you don\'t have the permission to ' . ucfirst($role));
            }
            return back()->with('error','Unauthorized action, you don\'t have the permission to ' . ucfirst($role));
        }
        return $next($request);
    }
}
