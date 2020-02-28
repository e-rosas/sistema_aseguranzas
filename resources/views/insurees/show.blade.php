@extends('layouts.app', ['title' => __('Insuree')])

@section('content')
    @include('layouts.headers.header', ['title' => __('View Insuree')])

    @include('components.patientInfo', ['person_data' => $insuree->person_data])
    @include('insurees.partials.beneficiariesTable', ['beneficiaries' => $beneficiaries])
    @include('insurees.partials.invoicesTable', ['invoices' => $insuree->person_data->invoices])
@endsection