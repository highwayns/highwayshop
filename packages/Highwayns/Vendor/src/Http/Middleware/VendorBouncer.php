<?php

namespace Highwayns\Vendor\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class VendorBouncer
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string|null  $guard
    * @return mixed
    */
    public function handle($request, Closure $next, $guard = 'vendoradmin')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('vendoradmin.session.create');
        }

        $this->checkIfAuthorized($request);

        return $next($request);
    }

    public function checkIfAuthorized($request)
    {
        if (! $role = auth()->guard('vendoradmin')->user()->role)
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
