@extends('layouts.app', ['title' => __('Invoice Management')])

@section('content')
    @include('invoices.partials.header', ['title' => __('Add Invoice')])   

    <div class="container-fluid mt--7">
        <div class="row">
            {{-- Patient --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
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

                        <div class="pl-lg-4">
                            <button type="submit" class="btn btn-success mt-4 btn-block">{{ __('Save') }}</button>
                        </div>
                        </form>
                    </div>                    
                </div>               
            </div>
            {{-- Services --}}
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
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
                            <div class="col-md-2 col-auto form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <input type="numeric" min="1" name="quantity" id="input-quantity" class="form-control form-control-alternative{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                placeholder="1" value="{{ old('quantity') }}" required>
                            
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
                            <table id="services_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Code') }}</th>
                                        <th scope="col">{{ __('Description') }}</th>
                                        <th scope="col">{{ __('Price') }}</th>
                                        <th scope="col">{{ __('Discounted Price') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <div class="form-row">
                            
                            {{-- Remove --}}
                            <div class="text-right">
                                <button type="button" id="remove_selected" class="btn btn-danger btn-sm">{{ __('Remove selected') }}</button>
                            </div>
                        </div>
                    </div>                    
                </div>               
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
<script>
    // CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
                  console.log(response);
                  var markup = 
                "<tr>"+
                    "<td><input type='checkbox' name='service'></td>"
                    +"<td>" + response.code + "</td>"
                    +"<td>" + response.description + "</td>"
                    +"<td>" + response.price + "</td>"
                    +"<td>" + response.discounted_price + "</td>"
                    +"<td>" + quantity + "</td>"
                +"</tr>";
                $("#services_table tbody").append(markup);

                  
              }
          });
             return false;
    }
    $(document).ready(function(){
        $("#person_data_id").change(function(){

            var selectedService= $(this).children("option:selected").val();
    
            alert("You have selected the service - " + selectedService);
    
        });

        $("#add_service").click(function(){
            var quantity = document.getElementById("input-quantity").value;
            var service_id= $("#service_id").children("option:selected").val();

            getService(service_id, quantity);

        });
        $("#remove_selected").click(function(){

            $("#services_table tbody").find('input[name="service"]').each(function(){

                if($(this).is(":checked")){

                    $(this).parents("tr").remove();

                }

            });

        });
    });
</script>
    
@endpush