@extends('layouts.app', ['title' => __('Discount Management')])

@section('content')
    @include('layouts.headers.header', ['title' => __('Add Discount')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Discount Management') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('discounts.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('discounts.store') }}"  autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Discount Information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    {{--  Day range --}}
                                    <div class="form-group col-md-4 col-auto">
                                        <label class="form-control-label" for="input-day_start">{{ __('From') }}</label>
                                        <input  type="string" name="day_start" id="day_start" class="form-control form-control-alternative" 
                                        placeholder="{{ __('From') }}" value=0 required>
                                    
                                    </div>
                                    {{--  Day range --}}
                                    <div class="form-group col-md-4 col-auto">
                                        <label class="form-control-label" for="input-day_end">{{ __('To') }}</label>
                                        <input type="string" name="day_end" id="day_end" class="form-control form-control-alternative" 
                                        placeholder="{{ __('To') }}" value=30 required>
                                    
                                    </div>
                                    {{--  Range --}}
                                    <div class="form-group{{ $errors->has('range_of_days') ? ' has-danger' : '' }} col-md-4 col-auto">
                                        <label class="form-control-label" for="input-range_of_days">{{ __('Range of days') }}</label>
                                        <input type="string" name="range_of_days" id="input-range_of_days" class="form-control form-control-alternative{{ $errors->has('range_of_days') ? ' is-invalid' : '' }}" 
                                        placeholder="{{ __('Range of days') }}" value="{{ old('range_of_days') }}" required readonly>
                                    
                                        @if ($errors->has('range_of_days'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('range_of_days') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Percentage  --}}
                                <div class="form-group{{ $errors->has('percentage') ? ' has-danger' : '' }} col-md-4 col-auto">
                                    <label class="form-control-label" for="input-percentage">{{ __('Percentage') }}</label>
                                    <input type="number" step="0.1" min="0" max="100" name="percentage" id="input-percentage" class="form-control form-control-alternative{{ $errors->has('percentage') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Percentage') }}" value="{{ old('percentage') }}" required>
                                
                                    @if ($errors->has('percentage'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('percentage') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  Amount of days  --}}
                                <div class="form-group{{ $errors->has('amount_of_days') ? ' has-danger' : '' }} col-md-4 col-auto">
                                    <label class="form-control-label" for="input-amount_of_days">{{ __('Amount of days') }}</label>
                                    <input type="number" min="15" max="100" name="amount_of_days" id="input-amount_of_days" class="form-control form-control-alternative{{ $errors->has('amount_of_days') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Amount of days') }}" value="{{ old('amount_of_days') }}" required readonly>

                                    @if ($errors->has('amount_of_days'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_of_days') }}</strong>
                                        </span>
                                    @endif
                                </div>                     
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
<script>
        function calcRange(){
            
            var day_start = Number(document.getElementById("day_start").value); 
            var day_end = Number(document.getElementById("day_end").value);

            if(day_end > day_start){
                document.getElementById("input-range_of_days").value = day_start + ' - '+ day_end; 
                document.getElementById("input-amount_of_days").value = day_end - day_start; 
            }
            else{
                document.getElementById("input-range_of_days").value = -1; 
                document.getElementById("input-amount_of_days").value = ""; 
            }

        }
        $(document).ready(function(){
            const $source = document.getElementById('day_start');


            const typeHandler = function(e) {
                calcRange();
            }

            $source.addEventListener('input', typeHandler); // register for oninput
        });
</script>
@endpush