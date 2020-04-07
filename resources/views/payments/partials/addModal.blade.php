<div class="modal fade" id="modal-payment" role="dialog" aria-labelledby="modal-payment" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Add payment') }}</h6>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            {{--  Number --}}
                            <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" name="number" id="payment-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
                                    value="{{ $number ?? '' }}" placeholder="Number" required>
                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--  Invoice  --}}
                            <div class="form-group">
                                <select id='invoice' class="custom-select form-control"  style="width: 100%" name="invoice_id"> 
                                    <option value='0'>{{ __('Select invoice') }}</option>
                                </select>
                            </div>
                            {{--  amount  --}}
                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="payment-amount">{{ __('Amount paid') }}</label>
                                <input type="numeric" name="amount" id="payment-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Amount') }}" value=0>

                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--  Date  --}}
                            <div class="form-group {{ $errors->has('date') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="date" id="payment-date" class="form-control {{ $errors->has('date') ? ' is-invalid' : '' }}"
                                    value="{{ old('date') }}" required>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{--  date_service  --}}
                            <div class="form-group {{ $errors->has('date_service') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="date_service" id="payment-date_service" class="form-control {{ $errors->has('date_service') ? ' is-invalid' : '' }}"
                                    value="{{ old('date_service') }}" required>
                                    @if ($errors->has('date_service'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_service') }}</strong>
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
                                    <textarea type="text" rows="3" name="comments" id="payment-comments" class="form-control {{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                    value="{{ old('comments') }}" placeholder="{{ __('Comments') }}"></textarea>
                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="save_payment" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script>
    function setPaymentCount(){
        var n = document.getElementById("payments_table").rows.length;
        document.getElementById("payment-number").value = n;
    }
    function sendPayment(number, amount, date, comments, date_service, invoice_id){
        $.ajax({
            url: "{{route('payments.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id": {{ $person_data_id }},
                "number": number,
                "amount": amount,
                "date": date,
                "comments": comments,
                "date_service": date_service,
                "invoice_id": invoice_id,
            },
        success: function (response) {
            DisplayPayments(response.data);
            displayStats();
            $('#modal-payment').modal('hide');

            }
        });
            return false;
    }

    function displayStats(){
        $.ajax({
            url: "{{route('personstats.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id": {{ $person_data_id }},
            },
        success: function (response) {
            document.getElementById("total").innerHTML = response.data.total_amount_due;
            document.getElementById("amount-paid").innerHTML = response.data.amount_paid;
            document.getElementById("amount-due").innerHTML = response.data.amount_due;
            document.getElementById("total-total").innerHTML = response.data.total_total;
            if(response.data.status == 1){
                document.getElementById("personal-due").innerHTML = response.data.personal_amount_due;
                document.getElementById("stats-status").innerHTML = 'Personal discount';
                document.getElementById("add-personal-discount-button").style.display = 'none';
            }
            else if(response.data.status == 0){
                document.getElementById("personal-due").innerHTML = 'NA';
                document.getElementById("stats-status").innerHTML = 'Insurance discount';
                document.getElementById("add-personal-discount-button").style.display = 'block';
            }


            }
        });
            return false;
    }

    $("#save_payment").click(function(){

        var number = document.getElementById("payment-number").value;

        var amount = Number(document.getElementById("payment-amount").value);

        var date = document.getElementById("payment-date").value;
        var date_service = document.getElementById("payment-date_service").value;
        var invoice_id = document.getElementById("invoice").value;

        var comments = document.getElementById("payment-comments").value;

        if(amount > 0 && invoice_id > 0){
            sendPayment(number, amount, date, comments, date_service, invoice_id);
        }



    });
    $(document).ready(function(){
        $("#invoice").select2({
          minimumInputLength: 2,
          dropdownParent: $('#modal-payment'),
          ajax: { 
            url: "{{route('invoices.searchNumber')}}",
            type:'post',
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                _token: CSRF_TOKEN,
                person_data_id: {{ $person_data->id }},
                search: params.term // search term
              };
            },
            processResults: function (response) {
              return {
                results: response
              };
            },
            cache: true
          }
    
        });
    
    });
</script>

@endpush
