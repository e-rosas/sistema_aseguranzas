<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Select discounts') }}</h5>
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
                        {{--  Generate  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="generate" type="button" class="btn btn-outline-primary btn-sm btn-block">{{ __('Generate') }}</button>
                            </div>
                        </div>  
                        

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{--  Invoice --}}
                        <input type="hidden"  readonly  name="invoice_id" id="input-invoice_id" class="form-control"
                        value="{{ $invoice_id ?? '' }}" required>
                        <input  type="text" name="discounted_total" id="input-discounted_total" class="form-control"
                        value="{{ $discounted_total ?? '' }}" required>

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
                        {{--  Select discount  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="select" type="button" class="btn btn-outline-success btn-sm btn-block">{{ __('Select') }}</button>
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
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var appliedDiscounts = [];
    class AppliedDiscount {
        status = 'ACTIVE';
        end_date = new Date();
        discounted_total = 0;
        constructor(invoice_id, discount_id, discount_percentage, 
                    invoice_total, start_date, days, id){
            this.invoice_id = invoice_id;
            this.discount_id = discount_id;
            this.discount_percentage = discount_percentage;
            this.invoice_total = invoice_total;
            this.start_date = start_date.toISOString().split('T')[0]+' '+start_date.toTimeString().split(' ')[0];
            this.start = start_date;
            this.days = days;
            this.id = id;
        }

        get discountedTotal(){
            return this.calcDiscountedTotal();
        }

        calcDiscountedTotal(){
            this.discounted_total = this.discount_percentage * this.invoice_total / 100;
            return this.discounted_total;
        }

        get startDate(){
            return this.start.toLocaleString();
        }


        get endDate(){
            return this.calcEndDate().toLocaleString();
        }

        calcEndDate(){
            var result = new Date(this.start);
            this.end_date.setDate(result.getDate() + this.days);
            result = this.end_date;
            this.end_date = this.end_date.toISOString().split('T')[0]+' '+this.end_date.toTimeString().split(' ')[0];
            return result;
        }

    }

    function sendAppliedDiscounts(){
        $.ajax({
            url: "{{route('invoices.discounts')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "appliedDiscounts" : appliedDiscounts,
            },
        success: function (response) {

            discounts_invoice = response['data'];

            var output = "";

            for(var i = 0; i < discounts_invoice.length; i++){
                output += "<tr value="+discounts_invoice[i].id+">"
                    + "<td>  <input type='radio'  name='custom-radio-2'></td>"
                    + "<td id=percentage"+discounts_invoice[i].id+">" + discounts_invoice[i].discount_percentage + "</td>"
                    + "<td>" + discounts_invoice[i].discountedTotal + "</td>" 
                    + "<td>" + discounts_invoice[i].startDate + "</td>" 
                    + "<td>" + discounts_invoice[i].endDate + "</td>" 
                    + "<td id=days"+discounts_invoice[i].id+">" + discounts_invoice[i].days + "</td>"
                    +  "</tr>";
            }

            $('#diiscounts_invoice_table tbody').html(output);

            appliedDiscounts = [];
            displayAppliedDiscounts();

            $('#modal-form').modal('hide')
            
                

            }
        });
            return false;
    }

    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;

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

    function displayAppliedDiscounts(){
        var output = "";

        for(var i = 0; i < appliedDiscounts.length; i++){
            output += "<tr value="+appliedDiscounts[i].id+">"
                + "<td>  <input type='radio'  name='custom-radio-2'></td>"
                + "<td id=percentage"+appliedDiscounts[i].id+">" + appliedDiscounts[i].discount_percentage + "</td>"
                + "<td>" + appliedDiscounts[i].discountedTotal + "</td>" 
                + "<td>" + appliedDiscounts[i].startDate + "</td>" 
                + "<td>" + appliedDiscounts[i].endDate + "</td>" 
                + "<td id=days"+appliedDiscounts[i].id+">" + appliedDiscounts[i].days + "</td>"
                +  "</tr>";
        }

        $('#applied_discounts_table tbody').html(output);
    }


    $(document).ready(function(){
        $('#modal-form').on('shown.bs.modal', function (e) {
             getDiscounts();
        })

        
        document.getElementById("input-start_date").value = today;
        document.getElementById("input-date").value = today;


        $("#select").click(function(){
            sendAppliedDiscounts();

        });

        
          
          $("#generate").click(function(){
            appliedDiscounts = [];
            const invoice_id = Number(document.getElementById("input-invoice_id").value); 
            const invoice_total = Number(document.getElementById("input-discounted_total").value);

            var today2 = new Date();
            var time = today2.toTimeString().split(' ')[0]; 

            var date = document.getElementById("input-start_date").value; 
            var dateTime = date+' '+time;
            const start_date = new Date(dateTime);


            $("#discounts_table tbody").find('input[name="discount"]').each(function(){

                if($(this).is(":checked")){
                                 
                    var discount_id = Number($(this).parents("tr").attr('value'));
                    var discount_percentage = Number(document.getElementById("percentage"+discount_id).innerHTML);
                    
                    var days = Number(document.getElementById("days"+discount_id).innerHTML);
                    

                    appliedDiscounts.push(new AppliedDiscount(invoice_id, discount_id, discount_percentage, 
                                                invoice_total, start_date, days, appliedDiscounts.length));    

                }

            });


            displayAppliedDiscounts();
            


        });
    });
</script>
@endpush