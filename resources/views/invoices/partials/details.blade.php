{{--  Details  --}}
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-services-center">
                <div class="col-8 col-auto">
                    <h3 class="mb-0">{{ __('Invoice') }}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                {{--  number --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-number">{{ __('Number') }}</label>
                    <label id="label-num">{{ $invoice->number }}</label>

                </div>
                {{--  date  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-date">{{ __('Date') }}</label>
                    <label id="label-num">{{ $invoice->date->format('l jS \\of F Y') }}</label>

                </div>
                {{--  status --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-status">{{ __('Status') }}</label>
                    <label id="label-status">{{ $invoice->status }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  amount_paid  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_paid">{{ __('Amount paid') }}</label>
                    <label id="label-num">{{ $invoice->amount_paid }}</label>

                </div>
                {{--  amount_due  --}}
                <div class="col-md-4 col-auto form-group">
                    <label class="form-control-label" for="label-amount_due">{{ __('Amount due') }}</label>
                    <label id="label-num">{{ $invoice->getAmountDue() }}</label>

                </div>
            </div>
            <div class="form-row">
                {{--  Comments  --}}
                <div class="col-md-12 col-auto form-group">
                    <label class="form-control-label" for="label-comments">{{ __('Comments') }}</label>
                    <label id="label-num">{{ $invoice->comments }}</label>
                </div>
            </div>
            <div class="form-row">
                {{--  total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total">{{ __('Total') }}</label>
                    <label id="label-num">{{ $invoice->total }}</label>

                </div>
                {{--  sub_total  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-sub_total">{{ __('Subtotal') }}</label>
                    <label id="label-num">{{ $invoice->sub_total }}</label>

                </div>
                {{--  tax  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-tax">{{ __('Tax') }}</label>
                    <label id="label-num">{{ $invoice->tax }}</label>

                </div>
                {{--  total_with_discounts  --}}
                <div class="col-md-3 col-auto form-group">
                    <label class="form-control-label" for="label-total_with_discounts">{{ __('Total with discounts') }}</label>
                    <label id="label-num">{{ $invoice->total_with_discounts }}</label>

                </div>
            </div>
        </div>                    
    </div>               
</div>