@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.merchant_sources.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.merchant_sources.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('admin.merchant_sources.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.merchant_sources.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @inject('datagrid','Highwayns\Merchant\DataGrids\MerchantSourcesDataGrid')
            {!! $datagrid->render() !!}
            {{-- <datetime></datetime> --}}
        </div>
    </div>

@stop
