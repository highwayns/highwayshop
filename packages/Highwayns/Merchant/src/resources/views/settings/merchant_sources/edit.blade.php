@extends('admin::layouts.content')

@section('page_title')
    {{ __('merchantadmin::app.settings.merchant_sources.edit-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.merchant_sources.update', $user->id) }}" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('merchantadmin::app.settings.merchant_sources.edit-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('merchantadmin::app.settings.merchant_sources.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'{{ __('merchantadmin::app.settings.merchant_sources.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('merchantadmin::app.settings.merchant_sources.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('merchantadmin::app.settings.merchant_sources.name') }}&quot;" value="{{ $user->name }}"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('merchantadmin::app.settings.merchant_sources.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('merchantadmin::app.settings.merchant_sources.email') }}&quot;" value="{{ $user->email }}"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('merchantadmin::app.settings.merchant_sources.password') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">{{ __('merchantadmin::app.settings.merchant_sources.password') }}</label>
                                <input type="password" v-validate="'min:6|max:18'" class="control" id="password" name="password" data-vv-as="&quot;{{ __('merchantadmin::app.settings.merchant_sources.password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation">{{ __('merchantadmin::app.settings.merchant_sources.confirm-password') }}</label>
                                <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('merchantadmin::app.settings.merchant_sources.confirm-password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('merchantadmin::app.settings.merchant_sources.status-and-role') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                                <label for="role" class="required">{{ __('merchantadmin::app.settings.merchant_sources.role') }}</label>
                                <select v-validate="'required'" class="control" name="role_id" data-vv-as="&quot;{{ __('merchantadmin::app.settings.merchant_sources.role') }}&quot;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('merchantadmin::app.settings.merchant_sources.status') }}</label>
                                <span class="checkbox">
                                    <input type="checkbox" id="status" name="status"
                                    {{-- @if ($user->status == 0)
                                        value="false"
                                    @else
                                        value="true"
                                    @endif --}}

                                    {{ $user->status ? 'checked' : '' }}>

                                    <label class="checkbox-view" for="status"></label>
                                    {{ __('merchantadmin::app.settings.merchant_sources.account-is-active') }}
                                </span>
                            </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop