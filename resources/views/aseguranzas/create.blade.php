@extends('layouts.app', ['title' => __('Insurance Management')])

@section('content')
    @include('aseguranzas.partials.header', ['title' => __('Add Insurance')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Insurance Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('aseguranzas.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('aseguranzas.store') }}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Insurance information') }}</h6>
                            <div class="pl-lg-4">
                                {{--  Nombre de aseguranza  --}}
                                <div class="form-group{{ $errors->has('nombre') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nombre">{{ __('Name') }}</label>
                                    <input type="text" name="nombre" id="input-nombre" 
                                        class="form-control form-control-alternative{{ $errors->has('nombre') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Name') }}" value="{{ old('nombre') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Domicilio  --}}
                                <div class="form-group{{ $errors->has('domicilio') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-domicilio">{{ __('Address') }}</label>
                                    <input type="text" name="domicilio" id="input-domicilio" 
                                        class="form-control form-control-alternative{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Address') }}" value="{{ old('domicilio') }}" autofocus>

                                    @if ($errors->has('domicilio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('domicilio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Ciudad  --}}
                                <div class="form-group{{ $errors->has('ciudad') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ciudad">{{ __('City') }}</label>
                                    <input type="text" name="ciudad" id="input-ciudad" 
                                        class="form-control form-control-alternative{{ $errors->has('ciudad') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('City') }}" value="{{ old('ciudad') }}" autofocus>
                                
                                    @if ($errors->has('ciudad'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ciudad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Estado  --}}
                                <div class="form-group{{ $errors->has('estado') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-estado">{{ __('State') }}</label>
                                    <input type="text" name="estado" id="input-estado" 
                                        class="form-control form-control-alternative{{ $errors->has('estado') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('State') }}" value="{{ old('estado') }}" autofocus>
                                
                                    @if ($errors->has('estado'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('estado') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Codigo Postal  --}}
                                <div class="form-group{{ $errors->has('codigo_postal') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-codigo_postal">{{ __('Post Code') }}</label>
                                    <input type="text" name="codigo_postal" id="input-codigo_postal" 
                                        class="form-control form-control-alternative{{ $errors->has('codigo_postal') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Post Code') }}" value="{{ old('codigo_postal') }}" autofocus>
                                
                                    @if ($errors->has('codigo_postal'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('codigo_postal') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Telefono  --}}
                                <div class="form-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telefono">{{ __('Phone Number') }}</label>
                                    <input type="text" name="telefono" id="input-telefono" 
                                        class="form-control form-control-alternative{{ $errors->has('telefono') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Phone Number') }}" value="{{ old('telefono') }}" autofocus>
                                
                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Correo  --}}
                                <div class="form-group{{ $errors->has('correo_e') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-correo_e">{{ __('Email') }}</label>
                                    <input type="email" name="correo_e" id="input-correo_e" class="form-control form-control-alternative{{ $errors->has('correo_e') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Email') }}" value="{{ old('correo_e') }}" required>
                                
                                    @if ($errors->has('correo_e'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('correo_e') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Clave  --}}
                                <div class="form-group{{ $errors->has('clave') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-clave">ID</label>
                                    <input type="text" name="clave" id="input-clave" class="form-control form-control-alternative{{ $errors->has('clave') ? ' is-invalid' : '' }}" 
                                    placeholder="ID" value="{{ old('clave') }}" required>
                                
                                    @if ($errors->has('clave'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('clave') }}</strong>
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