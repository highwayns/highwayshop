@extends('admin::layouts.content')

@section('page_title')
    {{ __('agentadmin::app.settings.agent_sources.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.agent_sources.store') }}" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('agentadmin::app.settings.agent_sources.title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('agentadmin::app.settings.agent_sources.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.general') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">{{ __('agentadmin::app.settings.agent_sources.name') }}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.name') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required">{{ __('agentadmin::app.settings.agent_sources.email') }}</label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.email') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.password') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password">{{ __('agentadmin::app.settings.agent_sources.password') }}</label>
                                <input type="password" v-validate="'min:6|max:18'" class="control" id="password" name="password" ref="password" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation">{{ __('agentadmin::app.settings.agent_sources.confirm-password') }}</label>
                                <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.confirm-password') }}&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.status-and-role') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                                <label for="role" class="required">{{ __('agentadmin::app.settings.agent_sources.role') }}</label>
                                <select v-validate="'required'" class="control" name="role_id" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.role') }}&quot;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status">{{ __('agentadmin::app.settings.agent_sources.status') }}</label>
                                <span class="checkbox">
                                    <input type="checkbox" id="status" name="status" value="1">
                                    <label class="checkbox-view" for="status"></label>
                                    {{ __('agentadmin::app.settings.agent_sources.account-is-active') }}
                                </span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.vendor') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('vendor_id') ? 'has-error' : '']">
                                <label for="vendor" class="required">{{ __('agentadmin::app.settings.agent_sources.vendor') }}</label>
                                <select v-validate="'required'" class="control" name="vendor_id" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.vendor') }}&quot;">
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                                <span class="control-error" v-if="errors.has('vendor_id')">@{{ errors.first('vendor_id') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.address') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('city') ? 'has-error' : '']">
                                <label for="city" class="required">{{ __('agentadmin::app.settings.agent_sources.city') }}</label>
                                <input v-validate="'required'" class="control" id="city" name="city" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.city') }}&quot;" value="{{ old('city') }}"/>
                                <span class="control-error" v-if="errors.has('city')">@{{ errors.first('city') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('pref') ? 'has-error' : '']">
                                <label for="pref" class="required">{{ __('agentadmin::app.settings.agent_sources.pref') }}</label>
                                <input v-validate="'required'" class="control" id="pref" name="pref" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.pref') }}&quot;" value="{{ old('pref') }}"/>
                                <span class="control-error" v-if="errors.has('pref')">@{{ errors.first('pref') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('address') ? 'has-error' : '']">
                                <label for="address" class="required">{{ __('agentadmin::app.settings.agent_sources.address') }}</label>
                                <input v-validate="'required'" class="control" id="address" name="address" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.address') }}&quot;" value="{{ old('address') }}"/>
                                <span class="control-error" v-if="errors.has('address')">@{{ errors.first('address') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('postcode') ? 'has-error' : '']">
                                <label for="postcode" class="required">{{ __('agentadmin::app.settings.agent_sources.postcode') }}</label>
                                <input v-validate="'required'" class="control" id="postcode" name="postcode" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.postcode') }}&quot;" value="{{ old('postcode') }}"/>
                                <span class="control-error" v-if="errors.has('postcode')">@{{ errors.first('postcode') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'{{ __('agentadmin::app.settings.agent_sources.agency_denki_shop_code') }}'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('building_name') ? 'has-error' : '']">
                                <label for="building_name" class="required">{{ __('agentadmin::app.settings.agent_sources.building_name') }}</label>
                                <input v-validate="'required'" class="control" id="building_name" name="building_name" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.building_name') }}&quot;" value="{{ old('building_name') }}"/>
                                <span class="control-error" v-if="errors.has('building_name')">@{{ errors.first('building_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('tel') ? 'has-error' : '']">
                                <label for="tel" class="required">{{ __('agentadmin::app.settings.agent_sources.tel') }}</label>
                                <input v-validate="'required'" class="control" id="tel" name="tel" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.tel') }}&quot;" value="{{ old('tel') }}"/>
                                <span class="control-error" v-if="errors.has('tel')">@{{ errors.first('tel') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('fax') ? 'has-error' : '']">
                                <label for="fax" class="required">{{ __('agentadmin::app.settings.agent_sources.fax') }}</label>
                                <input v-validate="'required'" class="control" id="fax" name="fax" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.fax') }}&quot;" value="{{ old('fax') }}"/>
                                <span class="control-error" v-if="errors.has('fax')">@{{ errors.first('fax') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('agency_denki_shop_code') ? 'has-error' : '']">
                                <label for="agency_denki_shop_code" class="required">{{ __('agentadmin::app.settings.agent_sources.agency_denki_shop_code') }}</label>
                                <input v-validate="'required'" class="control" id="agency_denki_shop_code" name="agency_denki_shop_code" data-vv-as="&quot;{{ __('agentadmin::app.settings.agent_sources.agency_denki_shop_code') }}&quot;" value="{{ old('agency_denki_shop_code') }}"/>
                                <span class="control-error" v-if="errors.has('agency_denki_shop_code')">@{{ errors.first('agency_denki_shop_code') }}</span>
                            </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
@stop