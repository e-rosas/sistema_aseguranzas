
{{--      <div class="card-body">
        <form method="post" action="{{ route('persondata.store') }}" autocomplete="off">
            @csrf  --}}
            
            <h6 class="heading-small text-muted mb-4">{{ __('Information') }}</h6>
            <div class="pl-lg-4">
                {{--  Names  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-last_name">{{ __('Last name') }}</label>
                        <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last name') }}" value="{{ old('last_name') }}" required autofocus>
                    
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('maiden_name') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-maiden_name">{{ __('Maiden name') }}</label>
                        <input type="text" name="maiden_name" id="input-maiden_name" class="form-control form-control-alternative{{ $errors->has('maiden_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Maiden name') }}" value="{{ old('maiden_name') }}" required autofocus>
                    
                        @if ($errors->has('maiden_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('maiden_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--  Birth and address  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('birth_date') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-birth_date">{{ __('Birth date') }}</label>
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input name="birth_date" id="input-birth_date" class="form-control datepicker form-control-alternative{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Birth date') }}" type="text" value="{{ old('birth_date') }}" required>
                        </div>
                        @if ($errors->has('birth_date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('birth_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} col-8">
                        <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                        <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" value="{{ old('address') }}" required>
                    
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--  City, state, postal code  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-city">{{ __('City') }}</label>
                        <input type="text" name="city" id="input-city" class="form-control form-control-alternative{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('City') }}" value="{{ old('city') }}" required>
                    
                        @if ($errors->has('city'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-state">{{ __('State') }}</label>
                        <input type="text" name="state" id="input-state" class="form-control form-control-alternative{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="{{ __('State') }}" value="{{ old('state') }}" required>
                    
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('postal_code') ? ' has-danger' : '' }} col-4">
                        <label class="form-control-label" for="input-postal_code">{{ __('Postal code') }}</label>
                        <input type="text" name="postal_code" id="input-postal_code" class="form-control form-control-alternative{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" placeholder="{{ __('Postal code') }}" value="{{ old('postal_code') }}" required>
                    
                        @if ($errors->has('postal_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('postal_code') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{--  Phone, email, insured  --}}
                <div class="row">
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }} col-6">
                        <label class="form-control-label" for="input-phone">{{ __('Phone') }}</label>
                        <input type="text" name="phone" id="input-phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" value="{{ old('phone') }}" required>
                    
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} col-6">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
    
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox mb-3 col-4">
                    <input type="checkbox" name="insured" id="input-insured" class="custom-control-input">
                    <label class="custom-control-label" for="input-insured">{{ __('Insured') }}</label>    
                </div>
            </div>

{{--          </form>
    </div>  --}}
    @push('js')
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    @endpush
   

