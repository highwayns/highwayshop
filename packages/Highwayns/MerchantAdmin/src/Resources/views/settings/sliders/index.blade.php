@extends('agentadmin::layouts.content')

@section('page_title')
    {{ __('admin::app.settings.sliders.title') }}
@stop

@section('content')


    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('admin::app.settings.sliders.title') }}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('agentadmin.sliders.store') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.settings.sliders.add-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">
            @inject('sliders','Highwayns\AgentAdmin\DataGrids\SliderDataGrid')
            {!! $sliders->render() !!}
        </div>
    </div>
@stop