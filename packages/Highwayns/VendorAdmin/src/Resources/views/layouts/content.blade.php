@extends('vendoradmin::layouts.master')

@section('content-wrapper')
    <div class="inner-section">
    
        '@include ('vendoradmin::layouts.nav-aside')

        <div class="content-wrapper">

            '@include ('vendoradmin::layouts.tabs')

            @yield('content')

        </div>
        
    </div>
@stop