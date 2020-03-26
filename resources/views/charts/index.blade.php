@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="row">
            {{--  start_date  --}}
            <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" name="start_date" id="input-start_date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}"
                    value="{{ old('start_date') }}" required>
                    @if ($errors->has('start_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{--  end_date  --}}
            <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" name="end_date" id="input-end_date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}"
                    value="{{ old('end_date') }}" required>
                    @if ($errors->has('end_date'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            {{--  refresh  --}}
            <div class="col text-right">
                <button id="refresh" type="button" class="btn btn-primary btn-sm" onclick="RefreshPayments()">
                    <span class="btn-inner--icon"><i class="fas fa-sync"></i></span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Amount paid</h6>
                                <h2 class=" mb-0">Monthly</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="payment-amount-chart" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">

                @include('charts.payments')
            </div>
        </div>
    </div>
</div>


@endsection
@push('headjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endpush

