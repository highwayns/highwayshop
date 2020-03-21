@extends('agentadmin::layouts.master')

@section('content-wrapper')
    <div class="inner-section">
    
        @include ('agentadmin::layouts.nav-aside')

        <div class="content-wrapper">

            @include ('agentadmin::layouts.tabs')

            @yield('content')

        </div>
        
    </div>
@stop