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
    
    
@endsection

