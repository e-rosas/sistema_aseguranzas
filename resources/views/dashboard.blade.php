@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
           {{--  <!-- Card stats -->
            <div class="row">
                @include('components.discountStatsCard', ['title' => 'Total due', 'value' => $topPersons->person_stats->getAmount_due()])
                @include('components.discountStatsCard', ['title' => 'Total paid', 'value' => $topPersons->person_stats->getAmount_paid()])
            </div> --}}
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __('Discounts ending soon') }}</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Patient') }}</th>
                            <th scope="col">{{ __('Total') }}</th>
                            <th scope="col">{{ __('End date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                            <tr>
                                <td>
                                    @if ($discount->person_data->insured)
                                        <a href="{{ route('insurees.show', $discount->person_data->insuree) }}">
                                    @else
                                        <a href="{{ route('beneficiaries.show', $discount->person_data->beneficiary) }}">
                                    @endif
                                    {{ $discount->person_data->full_name }}  </a>
                                </td>
                                <td>{{ $discount->discounted_total}}</td>
                                <td>{{ $discount->end_date->format('m-d-Y')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __('Insurance discounts') }}</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Patient') }}</th>
                            <th scope="col">{{ __('Amount due') }}</th>
                            <th scope="col">{{ __('Amount paid') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($insurance_discounts as $discount)
                            <tr>
                                <td>
                                    @if ($discount->person_data->insured)
                                        <a href="{{ route('insurees.show', $discount->person_data->insuree) }}">
                                    @else
                                        <a href="{{ route('beneficiaries.show', $discount->person_data->beneficiary) }}">
                                    @endif
                                    {{ $discount->person_data->full_name }}  </a>
                                </td>
                                <td>{{ $discount->getAmount_due()}}</td>
                                <td>{{ $discount->getAmount_paid()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __('Personal discounts') }}</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Patient') }}</th>
                            <th scope="col">{{ __('Amount due') }}</th>
                            <th scope="col">{{ __('Amount paid') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personal_discounts as $discount)
                            <tr>
                                <td>
                                    @if ($discount->person_data->insured)
                                        <a href="{{ route('insurees.show', $discount->person_data->insuree) }}">
                                    @else
                                        <a href="{{ route('beneficiaries.show', $discount->person_data->beneficiary) }}">
                                    @endif
                                    {{ $discount->person_data->full_name }}  </a>
                                </td>
                                <td>{{ $discount->getPersonalAmountDue()}}</td>
                                <td>{{ $discount->getAmount_paid()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 


@endsection

