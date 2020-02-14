@extends('layouts.app', ['title' => __('Insurers Management')])

@section('content')
    @include('insurers.partials.header', ['title' => __('Add Insurers')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Insurers Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('insurers.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('insurers.store') }}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Insurers information') }}</h6>
                            <div class="pl-lg-4">
                                {{--  name de aseguranza  --}}
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" 
                                        class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  address  --}}
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="input-address" 
                                        class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Address') }}" value="{{ old('address') }}" autofocus>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  city  --}}
                                <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-city">{{ __('City') }}</label>
                                    <input type="text" name="city" id="input-city" 
                                        class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('City') }}" value="{{ old('city') }}" autofocus>
                                
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  state  --}}
                                <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-state">{{ __('State') }}</label>
                                    <input type="text" name="state" id="input-state" 
                                        class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('State') }}" value="{{ old('state') }}" autofocus>
                                
                                    @if ($errors->has('state'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Codigo Postal  --}}
                                <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-postal_code">{{ __('Post Code') }}</label>
                                    <input type="text" name="postal_code" id="input-postal_code" 
                                        class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Post Code') }}" value="{{ old('postal_code') }}" autofocus>
                                
                                    @if ($errors->has('postal_code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('postal_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  phone_number  --}}
                                <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone_number">{{ __('Phone Number') }}</label>
                                    <input type="text" name="phone_number" id="input-phone_number" 
                                        class="form-control form-control-alternative{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Phone Number') }}" value="{{ old('phone_number') }}" autofocus>
                                
                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Correo  --}}
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                                
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  code  --}}
                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-code">ID</label>
                                    <input type="text" name="code" id="input-code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                                    placeholder="ID" value="{{ old('code') }}" required>
                                
                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection