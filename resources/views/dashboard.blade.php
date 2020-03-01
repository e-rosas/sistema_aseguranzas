@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                @include('components.invoiceStatsCard', ['title' => 'Total', 'value' => $totals->getTotal()])
                @include('components.invoiceStatsCard', ['title' => 'Total with discounts', 'value' => $totals->getTotal_with_discounts()])
                @include('components.invoiceStatsCard', ['title' => 'Total due', 'value' => $totals->getAmount_due()])
                @include('components.invoiceStatsCard', ['title' => 'Total paid', 'value' => $totals->getAmount_paid()])
            </div>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __('Invoices') }}</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Number') }}</th>
                            <th scope="col">{{ __('Patient') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col">{{ __('Total') }}</th>
                            <th scope="col">{{ __('Total with discounts') }}</th>
                            <th scope="col">{{ __('Amount paid') }}</th>
                            <th scope="col">{{ __('Amount due') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topInvoices as $invoice)
                            <tr>
                                <td><a href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                                <td>
                                    {{-- @if ($invoice->person_data->insured)
                                        <a href="{{ route('insurees.show', ) }}">
                                    @else
                                        <a href="{{ route('beneficiaries.show', $invoice->getBeneficiary()) }}">
                                    @endif --}}
                                    {{ $invoice->person_data->fullName() }} {{-- </a> --}}
                                </td>
                                <td>{{ $invoice->date->format('M-d-Y') }}</td>
                                <td>{{ $invoice->total }}</td>
                                <td>{{ $invoice->total_with_discounts }}</td>
                                <td>{{ $invoice->amount_paid }}</td>
                                <td>{{ $invoice->amount_due }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    
@endsection

