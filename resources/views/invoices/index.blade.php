@extends('layouts.app', ['title' => __('Invoice management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="card-title">Invoices</h3>
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <!-- Search form -->
                                <form  method="get" action="{{ route('invoices.index') }}" >                           
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <select id='year' class="custom-select" name="year"> 
                                                <option value='0' {{ $year == 0 ? 'selected' : '' }} >All</option>
                                                <option value='2020' {{ $year == 2020 ? 'selected' : '' }}>2020</option>
                                                <option value='2019' {{ $year == 2019 ? 'selected' : '' }}>2019</option>
                                                <option value='2018' {{ $year == 2018 ? 'selected' : '' }}>2018</option>
                                                <option value='2017' {{ $year == 2017 ? 'selected' : '' }}>2017</option>
                                                <option value='2016' {{ $year == 2016 ? 'selected' : '' }}>2016</option>
                                                <option value='2015' {{ $year == 2015 ? 'selected' : '' }}>2015</option>
                                            </select>
                                        </div>

                                        <div class="col-md-7">
                                            <input name="search" value="{{ $search ?? '' }}" class="form-control" type="text" placeholder="Buscar" aria-label="Search"> 
                                        </div> 
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary btn-fab btn-icon">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>                  
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add Invoice</a>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Number') }}</th>
                                    <th scope="col">{{ __('Patient') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Year') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col">{{ __('Total with discounts') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <a href="{{ route('invoices.show', $invoice) }}">
                                                {{ $invoice->number}}
                                            </a>
                                        </td>
                                        <td>
                                            @if ($invoice->person_data->insured)
                                                <a href="{{ route('insurees.show', $invoice->person_data->insuree) }}">
                                            @else
                                                <a href="{{ route('beneficiaries.show', $invoice->person_data->beneficiary) }}">
                                            @endif
                                            {{ $invoice->person_data->full_name }}
                                        </td>
                                        <td>{{ $invoice->date->format('M-d-Y') }}</td>
                                        <td>{{ $invoice->year }}</td>
                                        <td>{{ $invoice->total }}</td>
                                        <td>{{ $invoice->total_with_discounts }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        {{--  <form action="{{ route('invoice.destroy', $invoice) }}" method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <a class="dropdown-item" href="{{ route('invoice.edit', $invoice) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this invoice?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    --}}
                                                        <a class="dropdown-item" href="{{ route('invoices.show', $invoice) }}">{{ __('View') }}</a>
                                                        <a class="dropdown-item" href="{{ route('invoices.edit', $invoice) }}">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $invoices->appends(['search' => $search ?? '', 'year' => $year ?? 0])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
