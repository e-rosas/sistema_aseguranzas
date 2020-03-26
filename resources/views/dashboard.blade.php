@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
           {{--  <!-- Card stats -->
            <div class="row">
                @include('components.person_dataStatsCard', ['title' => 'Total due', 'value' => $topPersons->person_stats->getAmount_due()])
                @include('components.person_dataStatsCard', ['title' => 'Total paid', 'value' => $topPersons->person_stats->getAmount_paid()])
            </div> --}}
        </div>
    </div>
</div>

{{-- <div class="row mt-5">
    <div class="col-xl-8 mb-5 mb-xl-0">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{ __('Patients') }}</h3>
                    </div>
                </div>
            </div>
            <div class="table-responsive table-sm">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Patient') }}</th>
                            <th scope="col">{{ __('Amount paid') }}</th>
                            <th scope="col">{{ __('Amount due') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topPersons as $person_data)
                            <tr>
                                <td>
                                    {{-- @if ($person_data->person_data->insured)
                                        <a href="{{ route('insurees.show', ) }}">
                                    @else
                                        <a href="{{ route('beneficiaries.show', $person_data->getBeneficiary()) }}">
                                    @endif
                                    {{ $person_data->person_data->fullName() }} {{-- </a>
                                </td>
                                <td>{{ $person_data->person_stats->getAmount_paid() }}</td>
                                <td>{{ $person_data->person_stats->getAmount_due() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}


@endsection

