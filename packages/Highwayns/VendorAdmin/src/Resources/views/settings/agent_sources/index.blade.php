@extends('vendoradmin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.agent_sources.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.agent_sources.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('vendoradmin.agent_sources.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.agent_sources.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('datagrid','Highwayns\VendorAdmin\DataGrids\VendorSourcesDataGrid')
            {!! $datagrid->render() !!}
            {{-- <datetime></datetime> --}}
        </div>
    </div>

@stop
