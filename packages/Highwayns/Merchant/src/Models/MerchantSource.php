<?php

namespace Highwayns\Merchant\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Highwayns\Merchant\Models\MerchantRole;
use Highwayns\Merchant\Notifications\MerchantResetPassword;
use Highwayns\Merchant\Contracts\MerchantSource as MerchantSourceContract;


class MerchantSource extends Authenticatable implements MerchantSourceContract
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
        return $this->belongsTo(MerchantRoleProxy::modelClass());
    }

    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MerchantResetPassword($token));
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