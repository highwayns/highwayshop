<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('admin')->group(function () {

        // Admin Routes
        Route::group(['middleware' => ['admin']], function () {
            // Agent Source Routes
            Route::get('/agent_sources', 'Highwayns\Agent\Http\Controllers\AgentSourceController@index')->defaults('_config', [
                'view' => 'admin::settings.agent_sources.index'
            ])->name('admin.agent_sources.index');

            Route::get('/agent_sources/create', 'Highwayns\Agent\Http\Controllers\AgentSourceController@create')->defaults('_config', [
                'view' => 'admin::settings.agent_sources.create'
            ])->name('admin.agent_sources.create');

            Route::post('/agent_sources/create', 'Highwayns\Agent\Http\Controllers\AgentSourceController@store')->defaults('_config', [
                'redirect' => 'admin.agent_sources.index'
            ])->name('admin.agent_sources.store');

            Route::get('/agent_sources/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@edit')->defaults('_config', [
                'view' => 'admin::settings.agent_sources.edit'
            ])->name('admin.agent_sources.edit');

            Route::put('/agent_sources/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@update')->defaults('_config', [
                'redirect' => 'admin.agent_sources.index'
            ])->name('admin.agent_sources.update');

            Route::post('/agent_sources/delete/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@destroy')->name('admin.agent_sources.delete');

            Route::post('/agentconfirm/destroy', 'Highwayns\Agent\Http\Controllers\AgentSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'admin.agent_sources.index'
            ])->name('admin.agents.confirm.destroy');

            // Agent Role Routes
            Route::get('/agentroles', 'Highwayns\Agent\Http\Controllers\AgentRoleController@index')->defaults('_config', [
                'view' => 'admin::settings.agent_roles.index'
            ])->name('admin.agentroles.index');

            Route::get('/agentroles/create', 'Highwayns\Agent\Http\Controllers\AgentRoleController@create')->defaults('_config', [
                'view' => 'admin::settings.agent_roles.create'
            ])->name('admin.agentroles.create');

            Route::post('/agentroles/create', 'Highwayns\Agent\Http\Controllers\AgentRoleController@store')->defaults('_config', [
                'redirect' => 'admin.agentroles.index'
            ])->name('admin.agentroles.store');

            Route::get('/agentroles/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@edit')->defaults('_config', [
                'view' => 'admin::settings.agent_roles.edit'
            ])->name('admin.agentroles.edit');

            Route::put('/agentroles/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@update')->defaults('_config', [
                'redirect' => 'admin.agentroles.index'
            ])->name('admin.agentroles.update');

            Route::post('/agentroles/delete/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@destroy')->name('admin.agentroles.delete');

        });
    });
});
