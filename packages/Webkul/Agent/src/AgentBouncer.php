<?php

namespace Webkul\Agent;

class AgentBouncer
{
    /**
     * Checks if user allowed or not for certain action
     *
     * @param  String $permission
     * @return Void
     */
    public function hasPermission($permission)
    {
        if (auth()->guard('agentadmin')->check() && auth()->guard('agentadmin')->user()->role->permission_type == 'all') {
            return true;
        } else {
            if (! auth()->guard('agentadmin')->check() || ! auth()->guard('agentadmin')->user()->hasPermission($permission))
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
        if (! auth()->guard('agentadmin')->check() || ! auth()->guard('agentadmin')->user()->hasPermission($permission))
            abort(401, 'This action is unauthorized');
    }
}