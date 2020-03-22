@extends('agentadmin::layouts.content')

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
                {{--  <a href="{{ route('agentadmin.users.create') }}" class="btn btn-lg btn-primary">
                    {{ __('Add Customer') }}
                </a>  --}}
            </div>
        </div>

        <div class="page-content">
            @inject('review','Highwayns\AgentAdmin\DataGrids\CustomerReviewDataGrid')
            {!! $review->render() !!}
        </div>
    </div>

@stop