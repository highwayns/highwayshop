<?php

namespace Highwayns\Merchant;

class MerchantBouncer
{
    /**
     * Checks if user allowed or not for certain action
     *
     * @param  String $permission
     * @return Void
     */
    public function hasPermission($permission)
    {
        if (auth()->guard('merchantadmin')->check() && auth()->guard('merchantadmin')->user()->role->permission_type == 'all') {
            return true;
        } else {
            if (! auth()->guard('merchantadmin')->check() || ! auth()->guard('merchantadmin')->user()->hasPermission($permission))
                return false;
        }

        return true;
    }

    /**
     * Checks if user allowed or not for certain action
     *
     * @param  String $permission
     * @return Void
     */
    public static function allow($permission)
    {
        if (! auth()->guard('merchantadmin')->check() || ! auth()->guard('merchantadmin')->user()->hasPermission($permission))
            abort(401, 'This action is unauthorized');
    }
}