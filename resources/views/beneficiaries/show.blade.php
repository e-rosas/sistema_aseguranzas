@extends('layouts.app', ['title' => __('Beneficiary')])

@section('content')
    @include('layouts.headers.header', ['title' => $beneficiary->person_data->fullName(), 'description' => $beneficiary->insuree->fullName() ])

    <div class="container-fluid mt--7">
        <div class="row"> 
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['title' => 'Total', 'value' => $totals->getTotal()])
                @include('components.invoiceStatsCard', ['title' => 'Total with discounts', 'value' => $totals->getTotal_with_discounts()])
                @include('components.invoiceStatsCard', ['title' => 'Amount paid', 'value' => $totals->getAmount_paid()])
                @include('components.invoiceStatsCard', ['title' => 'Amount due', 'value' => $totals->getAmount_due()])
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">        
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Insuree') }}</h5>
                                <span class="h2 font-weight-bold mb-0"> <a href="{{ route('insurees.show', $beneficiary->insuree) }}"> {{ $beneficiary->insuree->fullName()  }} </a></span>
                            </div>
                            <div class="col-auto">
                            <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            </div>
                        </div>
            
                    </div> 
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Invoices') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('insurees.partials.invoicesTable', ['invoices' => $invoices])
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $invoices->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    

                                    <div>
                                        <span class="heading"> {{ $totals->getInvoicesCount() }} </span>
                                        <span class="description">{{ __('Invoices') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ $beneficiary->person_data->fullName() }}<span class="font-weight-light"></span>
                            </h3>
                            <div class="h4 font-weight-300">
                                <span> {{ $beneficiary->person_data->birth_date->format('M-d-Y') }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $beneficiary->person_data->address }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $beneficiary->person_data->addressDetails() }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $beneficiary->person_data->phone_number }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <a href="mailto:{{$beneficiary->person_data->email}}">{{$beneficiary->person_data->email}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
@endsection