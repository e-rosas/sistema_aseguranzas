<div class="modal fade" id="modal-call" role="dialog" aria-labelledby="modal-call" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent">
                        <h6 class="heading-small text-muted mb-4">{{ __('Add call') }}</h6>
                        <h4>{{ $person_data->phone_number }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="form-group">
                            <div class="form-group">
                                {{--  Number --}}
                                <div class="form-group {{ $errors->has('number') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" name="number" id="input-number" class="form-control {{ $errors->has('number') ? ' is-invalid' : '' }}"
                                        placeholder="Number" required>
                                        @if ($errors->has('number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{--  Invoice  --}}
                                <div class="form-group">
                                    <select id='invoice_id' class="custom-select form-control"  style="width: 100%" name="invoice_id"> 
                                        <option value='0'>{{ __('Select invoice') }}</option>
                                    </select>
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
                                {{--  status  --}}
                                <div class="form-group {{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                        </div>
                                        <select class="form-control" id="input-status">
                                            <option>In process</option>
                                            <option>Deductibles</option>
                                            <option>Denied for non covered charges</option>
                                            <option>Paid</option>
                                            <option>Denied for timely filing</option>
                                          </select>
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
                                    <button id="save_call" class="btn btn-block btn-success">{{ __('Save') }}</button>
                                </div>
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    function sendCall(number, claim, date,
    comments, status, invoice_id){
        $.ajax({
            url: "{{route('calls.store')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "person_data_id": {{ $person_data->id }},
                "number": number,
                "claim": claim,
                "date": date,
                "comments": comments,
                "status": status,
                'invoice_id': invoice_id
            },
        success: function (response) {
            displayCalls(response.data);
            $('#modal-call').modal('hide')

            }
        });
        return false;
    }

    function showEditCallModal(id){

        getCallData(id); //on editCallModal
        $('#modal-update-call').modal('show')

    }

    function displayCalls(data){
        var calls = data;
        var output = "";

        for(var i = 0; i < calls.length; i++){
            output += "<tr value="+calls[i].id+">"
                + "<td>" + calls[i].number + "</td>"
                + "<td>" + calls[i].invoice + "</td>"
                + "<td>" + calls[i].date + "</td>"
                + "<td>" + calls[i].claim + "</td>"
                + "<td>" + calls[i].status + "</td>"
                + "<td>" + calls[i].comments+ "</td>"
                +'<td class="text-right"><button class="btn btn-icon btn-info btn-sm"  type="button" onClick="showEditCallModal(\'' + calls[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="DeleteCall(\'' + calls[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +"</td></tr>";
        }

        $('#calls_table tbody').html(output);
        setCallCount();
    }

    $("#save_call").click(function(){
        var number = document.getElementById("input-number").value;
        var claim = document.getElementById("input-claim").value;
        var date = document.getElementById("input-date").value;
        var comments = document.getElementById("input-comments").value;
        var status = document.getElementById("input-status").value;
        var invoice_id = document.getElementById("invoice_id").value;
        sendCall(number, claim, date, comments, status, invoice_id);


    });
    $(document).ready(function(){
        $("#invoice_id").select2({
          minimumInputLength: 2,
          dropdownParent: $('#modal-call'),
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
@push('headjs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush
