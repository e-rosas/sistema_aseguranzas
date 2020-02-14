@extends('layouts.app', ['title' => __('Insuree Management')])

@section('content')
    @include('insurees.partials.header', ['title' => __('Add Insuree')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Insuree Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('insurees.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <form method="post" action="{{ route('persondata.storeinsuree') }}" autocomplete="off">
                            @csrf
                            @component('components.register',['beneficiary'=>'0'])
                                
                            @endcomponent
                        <div class="pl-lg-4">
                            <label for="insurer_id" class="col-4 col-form-label">{{ __('Insurer') }}</label>
                                <select class="form-control{{ $errors->has('insurer_id') ? ' is-invalid' : '' }}" name="insurer_id">
                                @foreach($insurers as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                                </select>
                    
                                @if ($errors)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('insurer_id') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="pl-lg-4">
                            <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('Save') }}</button>
                        </div>
                        </form>
                    </div>
                </div>                    
            </div>
        </div>
    </div>      
        @include('layouts.footers.auth')
    </div>
@endsection