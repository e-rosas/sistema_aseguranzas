@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total amount due</h5>
                            <p class="h2 font-weight-bold mb-0"> {{ $stats['total_amount_due'] }} </p>
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
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total amount due (Insurance)</h5>
                            <p id="total-amount-due-insurance" class="h2 font-weight-bold mb-0">{{ $stats['insurance_amount_due'] }} </p>
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
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total amount due (Discount)</h5>
                            <p id="total-amount-due-personal" class="h2 font-weight-bold mb-0">{{ $stats['personal_amount_due']}}</p>
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
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Total amount paid</h5>
                            <p id="total-amount-paid" class="h2 font-weight-bold mb-0">{{ $stats['total_amount_paid']}}</p>
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
</div>
<div class="container-fluid">
    <div class="row">
        {{--  start_date  --}}
        <div class="form-group col-md-4">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" name="start_date" id="input-start_date" class="form-control"
                value="{{ $start->format('Y-m-d') }}" required>
            </div>
        </div>
        {{--  end_date  --}}
        <div class="form-group col-md-4">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" name="end_date" id="input-end_date" class="form-control"
                value="{{ $end->format('Y-m-d')  }}" required>
            </div>
        </div>
        {{--  refresh  --}}
        <div class="col-md-4 text-right">
            <button id="refresh" type="button" class="btn btn-info" onclick="RefreshPayments()">
                Refresh
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Payments</h6>
                            <h2 class=" mb-0">Amount paid</h2>
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
    <div class="row">
        <div class="col-xl-6">
            @include('charts.stats')
        </div>
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Discounts</h6>
                            <h2 class=" mb-0">Insurance</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="insurance-chart" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('headjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endpush

