<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Add discount') }}</h6>
                        {{--  Available discounts  --}}
                        <div class="table-responsive">
                            <table id="discounts_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Select') }}</th>
                                        <th scope="col">{{ __('Percentage') }}</th>
                                        <th scope="col">{{ __('Range of days') }}</th>
                                        <th scope="col">{{ __('Amount of days') }}</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                </tbody> 
                            </table>
                        </div>   
                        {{--  Generate  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="generate" type="button" class="btn btn-outline-primary btn-sm">{{ __('Generate') }}</button>
                            </div>
                        </div>  
                        {{--  Applied Discounts  --}}
                        <h6 class="heading-small text-muted mb-4">{{ __('Applied discounts') }}</h6>
                        <div class="table-responsive">
                            <table id="applied_discounts_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Select') }}</th>
                                        <th scope="col">{{ __('Percentage') }}</th>
                                        <th scope="col">{{ __('Total with discount') }}</th>
                                        <th scope="col">{{ __('Start date') }}</th>
                                        <th scope="col">{{ __('End date') }}</th>
                                        <th scope="col">{{ __('Amount of days') }}</th>
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
                                <input type="hidden"  readonly  name="invoice_id" id="input-invoice_id" class="form-control"
                                value="{{ $invoice_id ?? '' }}" required>
                                <input  type="text" name="discounted_total" id="input-discounted_total" class="form-control"
                                value="{{ $discounted_total ?? '' }}" required>
                                
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
    var appliedDiscounts = [];
    class AppliedDiscount {
        status = 'ACTIVE';

        constructor(invoice_id, discount_id, discount_percentage, 
                    discounted_total, start_date, days, id){
            this.invoice_id = invoice_id;
            this.discount_id = discount_id;
            this.discount_percentage = discount_percentage;
            this.discounted_total = discounted_total;
            this.start_date = start_date;
            this.days = days;
            this.id = id;
        }

        get discountedTotal(){
            return this.calcDiscountedTotal();
        }

        calcDiscountedTotal(){
            return this.discount_percentage * this.discounted_total / 100;
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
                const discounts = response['data'];
                var count = discounts.length;

                var output = "";

                for(var i = 0; i < count; i++){
                    output += "<tr value="+discounts[i].id+">"
                        + "<td>  <input type='checkbox' name='discount'>  </td>"
                        + "<td id=percentage"+discounts[i].id+">" + discounts[i].percentage + "</td>"
                        + "<td>" + discounts[i].range_of_days + "</td>" 
                        + "<td id=days"+discounts[i].id+">" + discounts[i].amount_of_days + "</td>"
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
          
          $("#generate").click(function(){
            appliedDiscounts = [];
            const invoice_id = Number(document.getElementById("input-invoice_id").value); 
            const discounted_total = Number(document.getElementById("input-discounted_total").value);
            var date = document.getElementById("input-start_date").value; 
            const start_date = new Date(date);
            console.log(start_date);

            $("#discounts_table tbody").find('input[name="discount"]').each(function(){

                if($(this).is(":checked")){
                                 
                    var discount_id = Number($(this).parents("tr").attr('value'));
                    var discount_percentage = Number(document.getElementById("percentage"+discount_id).innerHTML);
                    
                    var days = Number(document.getElementById("days"+discount_id).innerHTML);
                    console.log(days);

                    appliedDiscounts.push(new AppliedDiscount(invoice_id, discount_id, discount_percentage, 
                                                discounted_total, start_date, days, appliedDiscounts.length));

                    

                }

            });

            console.log(appliedDiscounts);

            var output = "";

            for(var i = 0; i < appliedDiscounts.length; i++){
                console.log(appliedDiscounts[i])
                output += "<tr value="+appliedDiscounts[i].id+">"
                    + "<td>  <input type='checkbox' name='applied_discount'>  </td>"
                    + "<td id=percentage"+appliedDiscounts[i].id+">" + appliedDiscounts[i].discount_percentage + "</td>"
                    + "<td>" + appliedDiscounts[i].discountedTotal + "</td>" 
                    + "<td>" + appliedDiscounts[i].start_date + "</td>" 
                    + "<td>" + appliedDiscounts[i].endDate + "</td>" 
                    + "<td id=days"+appliedDiscounts[i].id+">" + appliedDiscounts[i].days + "</td>"
                    +  "</tr>";
            }

            $('#applied_discounts_table tbody').html(output);


        });
    });
</script>
@endpush