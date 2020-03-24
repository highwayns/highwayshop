@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.vendor_sources.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.vendor_sources.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('admin.vendor_sources.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.vendor_sources.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('datagrid','Webkul\Admin\DataGrids\VendorSourcesDataGrid')
            {!! $datagrid->render() !!}
            {{-- <datetime></datetime> --}}
        </div>
    </div>

@stop
