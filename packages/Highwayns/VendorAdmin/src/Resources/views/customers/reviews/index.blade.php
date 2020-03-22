@extends('vendoradmin::layouts.content')

@section('page_title')
    {{ __('admin::app.customers.reviews.title') }}
@stop

@section('content')

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.customers.reviews.title') }}</h1>
            </div>
            <div class="page-action">
                {{--  <a href="{{ route('vendoradmin.users.create') }}" class="btn btn-lg btn-primary">
                    {{ __('Add Customer') }}
                </a>  --}}
            </div>
        </div>

        <div class="page-content">
            @inject('review','Highwayns\VendorAdmin\DataGrids\CustomerReviewDataGrid')
            {!! $review->render() !!}
        </div>
    </div>

@stop