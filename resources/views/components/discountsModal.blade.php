<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Add discount') }}</h6>
                        <div class="table-responsive">
                            <table id="discounts_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Select') }}</th>
                                        <th scope="col">{{ __('Range of days') }}</th>
                                        <th scope="col">{{ __('Percentage') }}</th>
                                        <th scope="col">{{ __('Amount of days') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>  
                                </tbody> 
                            </table>
                        </div>              
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('calls.store') }}"  autocomplete="off">
                            @csrf                     
                            <div class="form-group">
                                {{--  Invoice --}}
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                        <input readonly type="invoice_id" name="invoice_id" id="input-invoice_id" class="form-control"
                                        value="{{ $invoice_id ?? '' }}" required>
                                    </div>
                                </div>
                                
                                {{--  start_end_date  --}}
                                <div class="form-group {{ $errors->has('start_end_date') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="end_date" name="start_end_date" id="input-start_end_date" class="form-control {{ $errors->has('start_end_date') ? ' is-invalid' : '' }}" 
                                        value="{{ old('start_end_date') }}" required>
                                        @if ($errors->has('start_end_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('start_end_date') }}</strong>
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
                                {{--  discounted_total --}}
                                <div class="form-group {{ $errors->has('discounted_total') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-square"></i></span>
                                        </div>
                                        <input type="numeric" name="discounted_total" id="input-discounted_total" class="form-control {{ $errors->has('discounted_total') ? ' is-invalid' : '' }}" 
                                        value="{{ $discounted_total ?? '' }}" placeholder="discounted_total" required>
                                        @if ($errors->has('discounted_total'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('discounted_total') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
    </div>
</div>
@push('js')
<script>
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    class AppliedDiscount {
        status = 'ACTIVE';

        constructor(invoice_id, discount_id, discount_percentage, invoice_total, start_date, days){
            this.invoice_id = invoice_id;
            this.discount_id = discount_id;
            this.discount_percentage = discount_percentage;
            this.invoice_total = invoice_total;
        }

        get discountedTotal(){
            return this.calcDiscountedTotal();
        }

        calcDiscountedTotal(){
            return this.discount_percentage * this.invoice_total;
        }

        get endDate(){
            return this.calcEndDate();
        }

        calcEndDate(){
            var result = new Date(this.start_date);
            result.setDate(result.getDate() + this.days);
            return result;
        }

    }


    function getDiscounts(){
        $.ajax({
            url: "{{route('discounts.get')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
            },
        success: function (response) {
                console.log(response);
                const discounts = response['data'];
                var count = discounts.length;

                var output = "";

                for(var i = 0; i < count; i++){
                    console.log(response['data'][i]['percentage']);
                    output += "<tr value="+discounts[i].id+">"
                        + "<td>  <input type='checkbox' name='discount'>  </td>"
                        + "<td>" + discounts[i].percentage + "</td>"
                        + "<td>" + discounts[i].range_of_days + "</td>" 
                        + "<td>" + discounts[i].amount_of_days + "</td>"
                        +  "</tr>";

                }
                $('#discounts_table tbody').html(output);

            }
        });
            return false;
    }

    $(document).ready(function(){
        $('#modal-form').on('shown.bs.modal', function (e) {
             getDiscounts();
          })
    });
</script>
@endpush