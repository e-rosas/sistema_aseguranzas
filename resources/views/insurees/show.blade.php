@extends('layouts.app', ['title' => __('Insuree')])

@section('content')
    @include('layouts.headers.header', ['title' => __('View Insuree')])

    @include('components.patientInfo', ['person_data' => $insuree->person_data])
    <div class="row">
    </div>
    <h1> {{ $totals->getTotal() }} </h1>
    <h1> {{ $totals->getTotal_with_discounts() }} </h1>
    <h1> {{ $totals->getAmount_paid() }} </h1>
    <h1> {{ $totals->getAmount_due() }} </h1>
    @include('insurees.partials.beneficiariesTable', ['beneficiaries' => $beneficiaries])
    @include('insurees.partials.invoicesTable', ['invoices' => $insuree->person_data->invoices])
@endsection