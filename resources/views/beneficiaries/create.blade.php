@extends('layouts.app', ['title' => __('Beneficiary Management')])

@section('content')
    @include('layouts.headers.header', ['title' => __('Add Beneficiary')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Beneficiary Management') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('beneficiaries.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('persondata.storebeneficiary') }}" autocomplete="off">
                            @csrf
                        @component('components.register',['beneficiary' => '1'])
                            
                        @endcomponent
                        <div class="form-row">
                            <div class="form-group col-md-8 col-auto">
                                {{-- <label for="insuree_id" class="col-form-label">{{ __('Insuree') }}</label> --}}
                                @component('components.searchInsurees')
                                    
                                @endcomponent
                            </div>
                            <div class="form-group col-md-4 col-auto text-right">
                                <a href="{{ route('insurees.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insuree') }}</a>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('Save') }}</button>
                        </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection