@extends('vendoradmin::layouts.content')

@section('page_title')
    {{ __('admin::app.users.roles.title') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.users.roles.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('vendoradmin.roles.create') }}" class="btn btn-lg btn-primary">
                    {{ __('Add Role') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('roles','Highwayns\VendorAdmin\DataGrids\RolesDataGrid')
            {!! $roles->render() !!}
        </div>
    </div>
@stop
