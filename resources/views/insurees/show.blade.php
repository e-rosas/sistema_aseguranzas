@extends('layouts.app', ['title' => __('Insuree')])

@section('content')
    @include('layouts.headers.header', ['title' => $insuree->person_data->fullName(), 'description' => $insuree->insurance_id ])

    <div class="container-fluid mt--7">
        <div class="row"> 
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['title' => 'Total', 'value' => $stats->total_invoices->getTotal()])
                @include('components.invoiceStatsCard', ['title' => 'Total with discounts', 'value' => $stats->total_invoices->getTotal_with_discounts()])
                @include('components.invoiceStatsCard', ['title' => 'Amount paid', 'value' => $stats->total_payments->getAmount_paid()])
                @include('components.invoiceStatsCard', ['title' => 'Amount due', 'value' => $stats->getAmount_due()])
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
                                <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('insurees.partials.invoicesTable', ['invoices' => $insuree->person_data->invoices])
                </div>
            </div>
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <h3>
                            {{ $insuree->person_data->fullName() }}<span class="font-weight-light"></span>
                        </h3>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading"> {{ count($beneficiaries)}} </span>
                                        <span class="description">{{ __('Beneficiaries') }}</span>
                                    </div>

                                    <div>
                                        <span class="heading"> {{ $stats->total_invoices->getInvoicesCount() }} </span>
                                        <span class="description">{{ __('Invoices') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->birth_date->format('M-d-Y') }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->address }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->addressDetails() }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <span> {{ $insuree->person_data->phone_number }} </span>
                            </div>
                            <div class="h4 font-weight-300">
                                <a href="mailto:{{$insuree->person_data->email}}">{{$insuree->person_data->email}}</a>
                            </div>
                            <div class="h4 font-weight-400">
                                <a href="">{{$insuree->insurer->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @include('components.personTab', ['invoices'=>$insuree->person_data->invoices()->paginate(5), 'person_data'=>$insuree->person_data,
                    'stats'=>$stats, 'beneficiaries' => $beneficiaries])
                {{-- <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Beneficiaries') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('insurees.partials.beneficiariesTable', ['beneficiaries' => $beneficiaries])
                </div> --}}
            </div>
        </div>
    </div>
@endsection