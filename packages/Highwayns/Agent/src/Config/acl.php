<?php

return [
    [
        'key' => 'agent_sources',
        'name' => 'agentadmin::app.acl.agent-sources',
        'route' => 'admin.agent_sources.index',
        'sort' => 10
    ], [
        'key' => 'agent_sources.agent_sources',
        'name' => 'agentadmin::app.layouts.agent-sources',
        'route' => 'admin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'agent_sources.create',
        'name' => 'agentadmin::app.acl.create',
        'route' => 'admin.agent_sources.create',
        'sort' => 1
    ], [
        'key' => 'agent_sources.edit',
        'name' => 'agentadmin::app.acl.edit',
        'route' => 'admin.agent_sources.edit',
        'sort' => 2
    ], [
        'key' => 'agent_sources.delete',
        'name' => 'agentadmin::app.acl.delete',
        'route' => 'admin.agent_sources.delete',
        'sort' => 3
    ], [
        'key' => 'agent_sources.roles',
        'name' => 'agentadmin::app.acl.roles',
        'route' => 'admin.agentroles.index',
        'sort' => 2
    ], [
        'key' => 'agent_sources.roles.create',
        'name' => 'agentadmin::app.acl.create',
        'route' => 'admin.agentroles.create',
        'sort' => 1
    ], [
        'key' => 'agent_sources.roles.edit',
        'name' => 'agentadmin::app.acl.edit',
        'route' => 'admin.agentroles.edit',
        'sort' => 2
    ], [
        'key' => 'agent_sources.roles.delete',
        'name' => 'agentadmin::app.acl.delete',
        'route' => 'admin.agentroles.delete',
        'sort' => 3
    ],
];

?>