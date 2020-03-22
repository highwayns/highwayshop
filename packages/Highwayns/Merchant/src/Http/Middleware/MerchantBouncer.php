<?php

namespace Highwayns\Merchant\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MerchantBouncer
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string|null  $guard
    * @return mixed
    */
    public function handle($request, Closure $next, $guard = 'merchantadmin')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('merchantadmin.session.create');
        }

        $this->checkIfAuthorized($request);

        return $next($request);
    }

    public function checkIfAuthorized($request)
    {
        if (! $role = auth()->guard('merchantadmin')->user()->role)
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
