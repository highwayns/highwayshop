<?php

namespace Highwayns\Agent\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AgentBouncer
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string|null  $guard
    * @return mixed
    */
    public function handle($request, Closure $next, $guard = 'agentadmin')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('agentadmin.session.create');
        }

        $this->checkIfAuthorized($request);

        return $next($request);
    }

    public function checkIfAuthorized($request)
    {
        if (! $role = auth()->guard('agentadmin')->user()->role)
            abort(401, 'This action is unauthorized.');

        if ($role->permission_type == 'all') {
            return;
        } else {
            $acl = app('acl');

            if ($acl && isset($acl->roles[Route::currentRouteName()])) {
                bouncer()->allow($acl->roles[Route::currentRouteName()]);
            }
        }
    }
}
