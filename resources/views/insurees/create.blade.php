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
                        @include('layouts.register')
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                        </div>
                        </form>
                </div>                    
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection