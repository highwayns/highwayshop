<?php

namespace Webkul\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Agent\Models\AgentSource;
use Webkul\Agent\Contracts\AgentRole as RoleContract;

class AgentRole extends Model implements RoleContract
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
     * Get the agentadmins.
     */
    public function agentadmins()
    {
        return $this->hasMany(AgentSourceProxy::modelClass());
    }
}
