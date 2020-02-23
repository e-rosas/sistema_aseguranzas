@extends('layouts.app', ['title' => __('Invoice Management')])

@section('content')
    @include('invoices.partials.header', ['title' => __('Add Invoice')])   

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- Patient --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Patient') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                            @csrf
                            @component('components.searchPatients')
                                
                            @endcomponent

                        </form>
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
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
                        <form method="post" action="{{ route('invoices.store') }}" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                {{--  number --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-number">{{ __('Number') }}</label>
                                    <input type="text" name="number" id="input-number" class="form-control form-control-alternative{{ $errors->has('number') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Number') }}" value="{{ old('number') }}" required>

                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  date  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}"  type="date" required>
                                    </div>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  amount_paid  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('amount_paid') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount_paid">{{ __('Amount paid') }}</label>
                                    <input type="numeric" name="amount_paid" id="input-amount_paid" class="form-control form-control-alternative{{ $errors->has('amount_paid') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Amount paid') }}" value="{{ old('amount_paid') }}">

                                    @if ($errors->has('amount_paid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_paid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  amount_due  --}}
                                <div class="col-md-4 col-auto form-group{{ $errors->has('amount_due') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount_due">{{ __('Amount due') }}</label>
                                    <input type="numeric" name="amount_due" id="input-amount_due" class="form-control form-control-alternative{{ $errors->has('amount_due') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Amount due') }}" value="{{ old('amount_due') }}">

                                    @if ($errors->has('amount_due'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount_due') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  Comments  --}}
                                <div class="col-md-12 col-auto form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comments">{{ __('Comments') }}</label>
                                    <input type="text" name="comments" id="input-comments" class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Comments') }}" value="{{ old('comments') }}">

                                    @if ($errors->has('comments'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comments') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                {{--  total  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('total') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total">{{ __('Total') }}</label>
                                    <input type="numeric" name="total" id="input-total" class="form-control form-control-alternative{{ $errors->has('total') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Total') }}" value="{{ old('total') }}" readonly>

                                    @if ($errors->has('total'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  sub_total  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('sub_total') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-sub_total">{{ __('Subtotal') }}</label>
                                    <input type="numeric" name="sub_total" id="input-sub_total" class="form-control form-control-alternative{{ $errors->has('sub_total') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Subtotal') }}" value="{{ old('sub_total') }}" readonly>

                                    @if ($errors->has('sub_total'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sub_total') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  tax  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('tax') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-tax">{{ __('Tax') }}</label>
                                    <input type="numeric" name="tax" id="input-tax" class="form-control form-control-alternative{{ $errors->has('tax') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Tax') }}" value="{{ old('tax') }}" readonly>

                                    @if ($errors->has('tax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('tax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                {{--  total_with_discounts  --}}
                                <div class="col-md-3 col-auto form-group{{ $errors->has('total_with_discounts') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-total_with_discounts">{{ __('Total with discounts') }}</label>
                                    <input type="numeric" name="total_with_discounts" id="input-total_with_discounts" class="form-control form-control-alternative{{ $errors->has('total_with_discounts') ? ' is-invalid' : '' }}" 
                                    placeholder="{{ __('Total with discounts') }}" value="{{ old('total_with_discounts') }}" readonly>

                                    @if ($errors->has('total_with_discounts'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('total_with_discounts') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>               
            </div>
        </div>
        <div class="row">
            {{-- Services --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-services-center">
                            <div class="col-8 col-auto">
                                <h3 class="mb-0">{{ __('Services') }}</h3>
                            </div>
                            <div class="col-4 col-auto text-right">
                                <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">{{ __('Add Service') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Selecting service --}}
                        <div class="row">
                            <div class="col-md-6 col-auto">
                                @component('components.searchServices')
                                
                                @endcomponent
                            </div>
                            {{--  quantity  --}}
                            <div class=" col-auto form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <input type="numeric" min="1" name="quantity" id="input-quantity" class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                placeholder="1" value="1" required>
                            
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{-- Add --}}
                            <div class="col-md-4 col-auto">
                                <button type="button" id="add_service" class="btn btn-outline-success">{{ __('Add') }}</button>
                            </div>
                        </div>
                        
                        {{-- Table of services --}}
                        <div  class="table-responsive">
                            <table id="services_table" class="table align-services-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Description') }}</th>
                                        <th scope="col">{{ __('Price') }}</th>
                                        <th scope="col">{{ __('Discounted Price') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col">{{ __('Total Price') }}</th>
                                        <th scope="col">{{ __('Total Discounted Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <div class="form-row">                            
                            {{-- Remove --}}
                            <div class="text-right col-md-1 col-auto">
                                <button type="button" id="remove_selected" class="btn btn-danger btn-sm">{{ __('Remove selected') }}</button>
                            </div>
                            {{-- Confirm --}}
                            <div class="text-right col-md-11 col-auto">
                                <button type="button" id="save" class="btn btn-success  text-right">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>

        @include('items.partials.itemsModal')
        
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script>
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    class Service {
        quantity = 1;
        items = [];
        tax = 0;
        dtax = 0;
        sub_total = 0;
        sub_total_discounted = 0;
        total_price = 0;
        total_discounted_price = 0;
        constructor(service_id, description, price, discounted_price, quantity, id) {
            this.service_id = service_id;
            this.description = description;
            this.price = price;
            this.discounted_price = discounted_price;
            this.quantity = quantity;
            this.total_price = quantity * price;
            this.total_discounted_price = quantity * discounted_price;
            this.id = id;
        }

        // Add to cart
        addItemToCart(item_id, description, price, discounted_price, quantity, id, tax) {
            for(var item in this.items) {
                if(this.items[item].id === id) {
                    this.items[item].quantity += Number(quantity);
                    displayItems(this.items);
                    return;
                }
            }
            var tax = 0;
            var dtax = 0;
            if(tax){
                this.tax = price * TAX;
                this.dtax = discounted_price * TAX;
            }
            var item = new Item(item_id, description, price, discounted_price, id, tax, dtax);
            this.items.push(item);   
            console.log(this.items);
            displayItems(this.items);  
        }

        // Remove item from cart
        removeItemFromCart(id) {
            for(var item in this.items) {
                if(this.items[item].service_id === service_id) {
                    this.items[item].quantity --;
                    if(this.items[item].quantity === 0) {
                        this.items.splice(item, 1);
                    }
                    break;
                }
            };
        }

        removeItemFromCartAll(id) {
            for(var item in this.items) {
              if(this.items[item].service_id === service_id) {
                items.splice(item, 1);
                break;
              }
            }
            displayItems(this.items);  
        }

        // Total cart
        totalItemsCart() {
            this.tax = 0;
            this.dtax = 0;
            this.sub_total = 0;
            this.sub_total_discounted = 0;
            this.total_price = 0;
            this.total_discounted_price = 0;

            for(var item in this.items) {
                this.tax += this.items[item].tax;
                this.dtax += this.items[item].dtax;
                this.sub_total += this.items[item].sub_total_price;
                this.sub_total_discounted += this.items[item].sub_total_discounted_price;
                this.total_price += this.items[item].total_price;
                this.total_discounted_price += this.items[item].total_discounted_price;
            }
        }
        
    }

    class Item {
        quantity = 1;
        constructor(item_id, description, price, discounted_price, quantity, id, tax, dtax) {
            this.item_id = item_id;
            this.description = description;
            this.price = price;
            this.discounted_price = discounted_price;
            this.quantity = quantity;
            this.sub_total_price = quantity * price;
            this.sub_total_discounted_price = quantity * discounted_price;
            this.id = id;
            this.tax = tax;
            this.dtax = dtax;
            this.total_price = this.sub_total_price + this.tax;
            this.total_discounted_price = this.sub_total_discounted_price + this.dtax;
        }
    }

    const TAX = 0.08;

    services = [];
    tax = 0;
    dtax = 0;
    sub_total = 0;
    sub_total_discounted = 0;
    total = 0;
    total_with_discounts = 0;

    // Add to cart
    function addServiceToCart(service_id, description, price, discounted_price, quantity, id) {
        for(var service in this.services) {
            if(this.services[service].id === id) {
                this.services[service].quantity += Number(quantity);
                displayCart();
                return;
            }
        }
        var service = new Service(service_id, description, price, discounted_price, quantity, id);
        this.services.push(service);   
        console.log(services);
        displayCart();  
    }
    // Remove service from cart
    function removeServiceFromCart(service_id) {
        for(var service in this.services) {
            if(this.services[service].service_id === service_id) {
                this.services[service].quantity --;
                if(this.services[service].quantity === 0) {
                    this.services.splice(service, 1);
                }
                break;
            }
        };
    }

    function removeServiceFromCartAll(service_id) {
        for(var service in this.services) {
          if(this.services[service].service_id === service_id) {
            services.splice(service, 1);
            break;
          }
        }
        displayCart();
    }
    // Clear cart
    function clearCart(){
        this.services = [];
    }
    // Count cart 
    function totalCount() {
        var totalCount = 0;
        for(var service in this.services) {
            totalCount += this.services[service].quantity;
        }
        return totalCount;
    }
    // Total cart
    function totalCart() {
        this.tax = 0;
        this.dtax = 0;
        this.sub_total = 0;
        this.sub_total_discounted = 0;
        this.total = 0;
        this.total_with_discounts = 0;
        for(var service in this.services) {
            this.tax += this.services[service].tax;
            this.dtax += this.services[service].dtax;
            this.sub_total += this.services[service].total_price;
            this.sub_total_discounted += this.services[service].total_discounted_price;
            this.total += this.services[service].total_price;
            this.total_with_discounts += this.services[service].total_discounted_price;
        }
    }

    function totalDiscounts() {
        return Number(this.total_with_discounts);
    }

    function getService(id, quantity){
        $.ajax({
            url: "{{route('services.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "service_id" : id
            },
        success: function (response) {                
                addServiceToCart(response.id, response.description, 
                    response.price, response.discounted_price, quantity, services.length);                                    
            }
        });
            return false;
    }

    function getItem(service_id, item_id, quantity){
        $.ajax({
            url: "{{route('items.find')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "item_id" : item_id
            },
        success: function (response) {                
                addItemToService(service_id, response.id, response.description, 
                    response.price, response.discounted_price, response.tax, quantity, services.length);                                    
            }
        });
            return false;
    }

    function addItemToService(service_id, item_id, description, price, discounted_price, tax, quantity, id){

        //Find service in array
        var service = this.services.find(s => s.id == service_id);
        
        service.addItemToCart(item_id, description, price, 
                discounted_price, quantity, services.length, tax);
    }

    function sendCart(person_data_id, date, amount_due, amount_paid,
         comments, number){
        $.ajax({
            url: "{{route('invoices.store')}}",
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id" : person_data_id,
                "date" : date,
                "amount_due" : amount_due,
                "amount_paid" : amount_paid,
                "comments" : comments,
                "number" : number,
                "services" : this.services,
                "total" : this.services.total,
                "sub_total" : this.services.sub_total,
                "sub_total_with_discounts" : this.services.sub_total_with_discounts,
                "total_with_discounts" : this.services.total_with_discounts,
                "tax" : this.services.tax,
                "tax_with_discounts" : this.services.dtax,
                "status": "due"
            },
        success: function (response) {
            setTimeout(function() {
                window.location.href = response;
              }, 1000);
                                                   
            }
        });
            return false;
    }

    var selectedServiceId;

    function showProductsModal(id){
        selectedServiceId = id;
        //Find service in array
        var service = services.find(s => s.id == id);
        service.totalItemsCart();
        displayItems(service.items);
        $('#modal-items').modal('show')

    }

    function displayItems(products) {
        var output = "";
        for(var i in products) {
          output += "<tr value="+products[i].id+">"
            + "<td>" + products[i].description + "</td>"
            + "<td>" + products[i].price + "</td>" 
            + "<td>" + products[i].discounted_price + "</td>"
            + "<td>" + products[i].quantity + "</td>"
            + "<td>" + products[i].total_price + "</td>"
            + "<td>" + products[i].total_discounted_price +"</td></tr>";
        }
        $('#items_table tbody').html(output);
         
    }
   

    function displayCart() {
        var output = "";
        for(var i in this.services) {
          output += "<tr value="+this.services[i].id+">"
            + "<td>  <input type='checkbox' name='service'>  </td>"
            + "<td>" + this.services[i].description + "</td>"
            + "<td>" + this.services[i].price + "</td>" 
            + "<td>" + this.services[i].discounted_price + "</td>"
            + "<td>" + this.services[i].quantity + "</td>"
            + "<td>" + this.services[i].total_price + "</td>"
            + "<td>" + this.services[i].total_discounted_price + '</td>'
            +'<td><button type="button" onClick="showProductsModal(\'' + this.services[i].id + '\')">Add</button>'
            +'</td> </tr>';
        }
        $('#services_table tbody').html(output);
        document.getElementById("input-total").value = totalCart();
        document.getElementById("input-total_with_discounts").value = totalDiscounts();
        document.getElementById("input-amount_due").value = totalDiscounts();
        document.getElementById("input-sub_total").value = 0;
        document.getElementById("input-tax").value = 0; 
        document.getElementById("input-amount_paid").value = 0; 
    }
    const current_date = new Date();
    var dd = String(current_date.getDate()).padStart(2, '0');
    var mm = String(current_date.getMonth() + 1).padStart(2, '0');
    var yyyy = current_date.getFullYear();

    var today = yyyy + '-' + mm + '-' + dd;
    $(document).ready(function(){
        document.getElementById("input-date").value = today;

        $("#person_data_id").change(function(){

            var selectedService= $(this).children("option:selected").val();
    
        });

        $("#add_service").click(function(){
            var quantity = Number(document.getElementById("input-quantity").value);
            if(quantity > 0){
                var service_id= $("#service_id").children("option:selected").val();
                getService(service_id, quantity);
            }
            
        });

        $("#add_item").click(function(){
            var quantity = Number(document.getElementById("input-product-quantity").value);
            if(quantity > 0){
                var item_id= $("#item_id").children("option:selected").val();
                getItem(selectedServiceId, item_id, quantity);
            }
            
        });

        
        $("#save").click(function(){
            var person_data_id= $("#person_data_id").children("option:selected").val();
            var date = document.getElementById("input-date").value; 
            var amount_due = Number(document.getElementById("input-amount_due").value); 
            var amount_paid = Number(document.getElementById("input-amount_paid").value); 
            var comments = document.getElementById("input-comments").value;
            var number = document.getElementById("input-number").value;  
            sendCart(person_data_id, date, amount_due, amount_paid, comments, number);
            

        });
        $("#remove_selected").click(function(){

            $("#services_table tbody").find('input[name="service"]').each(function(){

                if($(this).is(":checked")){
                    var id = Number($(this).parents("tr").attr('value'));
                    removeServiceFromCartAll(id);                 
                }

            });
            displayCart();

        });
    });
    displayCart();
</script>
    
@endpush