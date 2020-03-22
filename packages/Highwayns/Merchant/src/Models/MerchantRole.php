<?php

namespace Highwayns\Merchant\Models;

use Illuminate\Database\Eloquent\Model;
use Highwayns\Merchant\Models\MerchantSource;
use Highwayns\Merchant\Contracts\MerchantRole as RoleContract;

class MerchantRole extends Model implements RoleContract
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'permission_type', 'permissions',
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    /**
     * Get the merchantadmins.
     */
    public function merchantadmins()
    {
        return $this->hasMany(MerchantSourceProxy::modelClass());
    }
}
