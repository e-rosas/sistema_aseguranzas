@extends('layouts.app', ['title' => __('Insuree')])

@section('content')
    @include('layouts.headers.header', ['title' => $insuree->person_data->fullName(), 'description' => $insuree->insurance_id ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0 card-group">
                @include('components.invoiceStatsCard', ['id' => 'total','title' => 'Total', 'value' => $stats->getTotal()])
                @include('components.invoiceStatsCard', ['id' => 'amount-paid','title' => 'Amount paid', 'value' => $stats->getAmount_paid()])
                @include('components.invoiceStatsCard', ['id' => 'amount-due','title' => 'Amount due (insurance)', 'value' => $stats->getAmount_due()])
                @include('components.invoiceStatsCard', ['id' => 'personal-due','title' => 'Amount due (personal)', 'value' => $stats->getPersonalAmountDue()])
                @if ($stats->status==2)
                    @include('components.invoiceStatsCard', ['id' => 'total-total-due','title' => 'Amount due', 'value' => $stats->getTotalAmountDue()])
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-8">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            {{--  Latest call  --}}
                            @if ($insuree->person_data->calls->count()>0)
                            <div class="col-md-6 col-auto form-group">
                                <label class="form-control-label" for="label-latest_call">{{ __('Latest call') }}</label>
                                <label id="label-calls">{{ $insuree->person_data->calls[0]->date->format('l jS \\of F Y')}}</label>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            {{--  Latest payment  --}}
                            @if ($insuree->person_data->payments->count()>0)
                            <div class="col-md-6 col-auto form-group">
                                <label class="form-control-label" for="label-latest_call">{{ __('Latest payment') }}</label>
                                <label id="label-payments">{{ $insuree->person_data->payments[0]->date->format('l jS \\of F Y')}}</label>
                            </div>
                            @endif
                        </div>
                        </div>
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
                                        <span class="heading"> {{ $stats->getStatus() }} </span>
                                        <span class="description">{{ __('Status') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="h4 font-weight-300">
                                <span id="total-total"> {{ $stats->getTotalAmountDue() }} </span>
                            </div>
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
                @include('components.personTab', ['invoices'=>$invoices, 'person_data'=>$insuree->person_data,
                    'stats'=>$stats, 'beneficiaries' => $beneficiaries])
            </div>
        </div>
    </div>
@endsection
