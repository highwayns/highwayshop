<?php

namespace Webkul\Agent\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webkul\Agent\Models\AgentRole;
use Webkul\Agent\Notifications\AgentResetPassword;
use Webkul\Agent\Contracts\AgentSource as AgentSourceContract;


class AgentSource extends Authenticatable implements AgentSourceContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the role that owns the admin.
     */
    public function role()
    {
        return $this->belongsTo(AgentRoleProxy::modelClass());
    }

    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AgentResetPassword($token));
    }

    /**
     * Checks if admin has permission to perform certain action.
     *
     * @param  String  $permission
     * @return Boolean
     */
    public function hasPermission($permission)
    {
        if ($this->role->permission_type == 'custom' && ! $this->role->permissions)
            return false;

        return in_array($permission, $this->role->permissions);
    }
}