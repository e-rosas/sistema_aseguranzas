<div class="modal fade bd-example-modal-lg" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h5 class="heading-small text-muted mb-4">{{ __('Select discounts') }}</h5>
                        {{--  discount --}}
                        <div class="form-group {{ $errors->has('discount_percentage') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <label for="input-new_discount_percentage">{{ __('Add percentage') }}</label>
                                <input type="number" step="0.1" min="0" max="100" name="new_percentage" id="input-new_discount_percentage" class="form-control form-control-alternative"
                                value=10>
                            </div>
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
                        {{--  Generate  --}}
                        <div class="row">
                            <div class="col text-center">
                                <button id="generate" type="button" class="btn btn-outline-primary btn-sm btn-block">{{ __('Generate') }}</button>
                            </div>
                        </div>  
                        

                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        {{--  Invoice --}}
                        <input type="hidden"  readonly  name="person_data_id" id="input-person_data_id" class="form-control"
                        value="{{ $person_data_id ?? '' }}" required>
                        <input  type="hidden" name="discounted_total" id="input-total_invoices" class="form-control"
                        value="{{ $total_invoices ?? '' }}" required>

                        {{--  Applied Discounts  --}}
                        <h6 class="heading-small text-muted mb-4">{{ __('Applied discounts') }}</h6>
                        <div class="table-responsive">
                            <table id="applied_discounts_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Select') }}</th>
                                        <th scope="col">{{ __('Percentage') }}</th>
                                        <th scope="col">{{ __('Total with discount') }}</th>
                                        <th scope="col">{{ __('Difference') }}</th>
                                        <th scope="col">{{ __('Start date') }}</th>
                                        <th scope="col">{{ __('End date') }}</th>
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
    var percentages = [];
   
    class AppliedDiscount {
        active = 0;
        status = 'ACTIVE';
        discounted_total = 0;
        difference = 0;
        constructor(person_data_id, discount_percentage, 
                    total_invoices, start_date, end_date, id){
            this.person_data_id = person_data_id;
            this.discount_percentage = discount_percentage;
            this.invoice_total = invoice_total;
            this.discounted_total = discount_percentage * invoice_total / 100;
            this.difference = this.invoice_total - this.discounted_total;
            this.start_date = start_date.toISOString().split('T')[0]+' '+start_date.toTimeString().split(' ')[0];
            this.end_date = end_date.toISOString().split('T')[0]+' '+end_date.toTimeString().split(' ')[0];
            this.id = id;
        }

        get startDate(){
            return this.start.toLocaleString();
        }


        get endDate(){
            return this.end.toLocaleString();
        }

    }

    function sendAppliedDiscounts(){
        $.ajax({
            url: "{{route('person_data.discounts')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "appliedDiscounts" : appliedDiscounts,
            },
        success: function (response) {

            var discounts_invoice = response['data'];
            var output = "";

            for(var i = 0; i < discounts_invoice.length; i++){
                output += "<tr value="+discounts_invoice[i].id+">"
                    + "<td>" + discounts_invoice[i].discount.percentage + "</td>"
                    + "<td>" + discounts_invoice[i].discounted_total + "</td>" 
                    + "<td>" + discounts_invoice[i].start_date + "</td>" 
                    + "<td>" + discounts_invoice[i].end_date + "</td>" 
                    + "<td>" + discounts_invoice[i].discount.amount_of_days + "</td>"
                    + "<td>" + discounts_invoice[i].active  + "</td>"
                    +  "</tr>";
            }

            $('#discounts_invoice_table tbody').html(output);

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

    function displayAppliedDiscounts(){
        var output = "";

        for(var i = 0; i < appliedDiscounts.length; i++){
            output += "<tr value="+appliedDiscounts[i].id+">" 
                + "<td>  <input type='radio'  name='active' checked></td>"
                + "<td id=percentage"+appliedDiscounts[i].id+">" + appliedDiscounts[i].discount_percentage + "</td>"
                + "<td>" + appliedDiscounts[i].discounted_total + "</td>"
                + "<td>" + appliedDiscounts[i].difference + "</td>" 
                + "<td>" + appliedDiscounts[i].startDate + "</td>" 
                + "<td>" + appliedDiscounts[i].endDate + "</td>" 
                +  "</tr>";
        }

        $('#applied_discounts_table tbody').html(output);
    }

    function addPossibleDiscount(possibleDiscount){
        appliedDiscounts.push(possibleDiscount);
    }


    $(document).ready(function(){
        percentages = [20, 25, 30];
        $('#modal-form').on('shown.bs.modal', function (e) {
        })

        
        document.getElementById("input-start_date").value = today;
        document.getElementById("input-date").value = today;


        $("#select").click(function(){

            var i = 0;
            $("#applied_discounts_table tbody").find('input[name="active"]').each(function(){
                if($(this).is(":checked")){                  
                    index = i;                 
                    return false;                       
                }
                i++;

            });
            appliedDiscounts[i]['active'] = 1;
            sendAppliedDiscounts();

        });

        
          
        $("#generate").click(function(){
            appliedDiscounts = [];
            const person_data_id = Number(document.getElementById("input-person_data_id").value); 
            const total_invoices = Number(document.getElementById("input-discounted_total").value);

            var today2 = new Date();
            var time = today2.toTimeString().split(' ')[0]; 

            var date = document.getElementById("input-start_date").value; 
            var dateTime = date+' '+time;
            var start_date = new Date(dateTime);
            var enddate = document.getElementById("input-end_date").value;
            var end_date = new Date(enddate+' '+time);

            for(var i = 0; i < percentages.length; i++){
                var possibleDiscount = new AppliedDiscount(person_data_id,
                percentages[i], total_invoices, start_date, end_date, percentages.length);
                addPossibleDiscount(possibleDiscount);
            }

            

            $("#discounts_table tbody").find('input[name="discount"]').each(function(){

                if($(this).is(":checked")){
                                 
                                       

                }

            });


            displayAppliedDiscounts();
            


        });
    });
</script>
@endpush