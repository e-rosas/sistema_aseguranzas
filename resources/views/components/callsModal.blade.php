<div class="modal fade" id="modal-call" tabindex="-1" role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Add call') }}</h6>                 
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('calls.store') }}"  autocomplete="off">
                            @csrf                     
                            <div class="form-group">
                                {{--  Invoice --}}
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <input readonly type="hidden" name="invoice_id" id="input-invoice_id" class="form-control"
                                        value="{{ $invoice_id ?? '' }}" required>
                                    </div>
                                </div>
                                {{--  Number --}}
                                <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-square"></i></span>
                                        </div>
                                        <input type="number" name="number" id="input-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                        value="{{ $number ?? '' }}" placeholder="Number" required>
                                        @if ($errors->has('number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Claim  --}}
                                <div class="form-group {{ $errors->has('claim') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                        </div>
                                        <input type="text" name="claim" id="input-claim" class="form-control {{ $errors->has('claim') ? ' is-invalid' : '' }}" 
                                        value="{{ old('claim') }}" placeholder="{{ __('Claim') }}">
                                        @if ($errors->has('claim'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Date  --}}
                                <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input onchange="handler(event);" type="date" name="date" id="input-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}" 
                                        value="{{ old('date') }}" required>
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  comments  --}}
                                <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <textarea type="text" rows="3" name="comments" id="input-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}" 
                                        value="{{ old('comments') }}" placeholder="{{ __('Comments') }}"></textarea>
                                        @if ($errors->has('comments'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comments') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                   
                                <div class="text-center">
                                    <button id="save_call" type="submit" class="btn btn-block btn-success">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    function sendCall(){
        $.ajax({
            url: "{{route('calls.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": "{{ $invoice_id }}",


            },
        success: function (response) {
                

            }
        });
            return false;
    }

    $("#save_call").click(function(){
            
        


    });
</script>
    
@endpush