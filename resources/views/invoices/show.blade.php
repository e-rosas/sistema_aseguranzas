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
            @include('invoices.partials.details', ['invoice' => $invoice])
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
                        @component('components.servicesTable', ['services'=>$invoice->services])
                            
                        @endcomponent
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        <div class="col-md-12 col-auto text-right">
                            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#modal-form">Add</i></button>
                            <br />
                            @component('components.discountsModal',['invoice_id'=>$invoice->id, 'discounted_total'=>$invoice->total_with_discounts])
                                
                            @endcomponent
                        </div>
                        @component('components.discountsTable', ['discounts'=>$invoice->discounts])
                            
                        @endcomponent
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                        <div class="col-md-12 col-auto text-right">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-call">Add</i></button>
                            <br />
                            @component('components.callsModal',['number'=>$invoice->calls->count() + 1, 'invoice_id'=>$invoice->id])
                                
                            @endcomponent
                        </div>
                        @component('components.callsTable', ['calls'=>$invoice->calls])
                            
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
    
@endsection