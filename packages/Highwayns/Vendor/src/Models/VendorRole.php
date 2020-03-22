<?php

namespace Highwayns\Vendor\Models;

use Illuminate\Database\Eloquent\Model;
use Highwayns\Vendor\Models\VendorSource;
use Highwayns\Vendor\Contracts\VendorRole as RoleContract;

class VendorRole extends Model implements RoleContract
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
     * Get the vendoradmins.
     */
    public function vendoradmins()
    {
        return $this->hasMany(VendorSourceProxy::modelClass());
    }
}
