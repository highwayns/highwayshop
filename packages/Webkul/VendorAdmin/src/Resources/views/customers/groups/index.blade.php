@extends('vendoradmin::layouts.content')

@section('page_title')
    {{ __('admin::app.customers.groups.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.customers.groups.title') }}</h1>
            </div>
            <div class="page-action">
                <a href="{{ route('vendoradmin.groups.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.customers.groups.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('customerGroup','Webkul\VendorAdmin\DataGrids\CustomerGroupDataGrid')
            {!! $customerGroup->render() !!}
        </div>
    </div>

@stop