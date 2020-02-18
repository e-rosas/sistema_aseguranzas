@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('invoices.partials.header', ['title' => __('View Invoice')])
    <div class="container-fluid mt--7">
        <div class="row">
            @component('components.patientInfo', ['person_data' => $invoice->person_data])

            @endcomponent
            {{--  Insuree ?  --}} 
            @if ($invoice->person_data->insured == 0)
                @component('components.patientInfo', ['person_data' => $invoice->findInsuree()])

                @endcomponent        
            @endif
            @component('components.insurerInfo', ['insurer' => $invoice->findInsurer()])

            @endcomponent
        </div>
        <div class="row">
            {{--  Details  --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Invoice') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label class="h3" for="i_number">Number</label>
                            <label id="i_number" class="h4">
                                {{ $invoice->number }}
                            </label>
                        </div>
                        <div class="h3">
                            {{ $invoice->number }}
                        </div>
                        <div class="h4 font-weight-300">
                            <span> {{ $invoice->birth_date }} </span>
                        </div>

                    </div>                    
                </div>               
            </div>
        </div>
        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i> {{ __('Services') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i> {{ __('Discounts') }} </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i> {{ __('Calls') }}</a>
                </li>
            </ul>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            {{-- Services --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Services') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Selecting service --}}
                        <div class="row">
                            
                        </div>
                        
                        {{-- Table of services --}}
                        <div  class="table-responsive">
                            <table id="services_table" class="table align-services-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Description') }}</th>
                                        <th scope="col">{{ __('Price') }}</th>
                                        <th scope="col">{{ __('Discounted Price') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
    
@endsection