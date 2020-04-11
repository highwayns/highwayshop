<?php

return [
    [
        'key' => 'settings.agent_sources',
        'name' => 'admin::app.acl.agent-sources',
        'route' => 'admin.agent_sources.index',
        'sort' => 10
    ], [
        'key' => 'settings.agent_sources.agent_sources',
        'name' => 'admin::app.layouts.agent-sources',
        'route' => 'admin.agent_sources.index',
        'sort' => 1,
        'icon-class' => ''
    ], [
        'key' => 'settings.agent_sources.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.agent_sources.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.agent_sources.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.agent_sources.delete',
        'sort' => 3
    ], [
        'key' => 'settings.agent_sources.roles',
        'name' => 'admin::app.acl.roles',
        'route' => 'admin.agentroles.index',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.create',
        'name' => 'admin::app.acl.create',
        'route' => 'admin.agentroles.create',
        'sort' => 1
    ], [
        'key' => 'settings.agent_sources.roles.edit',
        'name' => 'admin::app.acl.edit',
        'route' => 'admin.agentroles.edit',
        'sort' => 2
    ], [
        'key' => 'settings.agent_sources.roles.delete',
        'name' => 'admin::app.acl.delete',
        'route' => 'admin.agentroles.delete',
        'sort' => 3
    ],
];

?>