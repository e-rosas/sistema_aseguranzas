{{-- Table of payments --}}
<div  class="table-responsive">
    <table id="payments_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Amount') }}</th>
                <th scope="col">{{ __('Claim') }}</th>
                <th scope="col">{{ __('Comments') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->number}}</td>
                    <td>{{ $payment->date->format('M-d-Y')}}</td>
                    <td>{{ $payment->amount}}</td>
                    <td>{{ $payment->claim}}</td>
                    <td>{{ $payment->comments}}</td>
                     <td class="td-actions text-right">
                        <button class="btn btn-info btn-sm btn-icon" rel="tooltip"  type="button" onClick="mostrarModalEditar({{ $payment->id }})">
                                <i class="fas fa-pencil-alt fa-2 "></i>
                        </button>
                        <button rel="tooltip" class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete({{ $payment->id }})">
                                <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('js')
<script>
    function DisplayPayments(data){
        var payments = data;
        var output = "";
        for(var i = 0; i < payments.length; i++){
            output += "<tr value="+payments[i].id+">"
                + "<td>" + payments[i].id + "</td>"
                + "<td>" + payments[i].nombre + "</td>"
                + "<td>" + payments[i].numero_serie + "</td>"
                + "<td>" + payments[i].departamento + "</td>"
                +'<td class="text-right"><button class="btn btn-info btn-sm btn-icon"  type="button" onClick="mostrarModalEditar(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fas fa-pencil-alt fa-2"></i></span></button>'
                +'<button class="btn btn-success btn-sm btn-icon"  type="button" onClick="mostrarModalpayments(\'' + payments[i].id + '\',\'' + payments[i].nombre + '\')"><span class="btn-inner--icon"><i class="fa fa-eye"></i></span></button>'
                +'<button class="btn btn-danger btn-sm btn-icon"  type="button" onClick="Delete(\'' + payments[i].id + '\')"><span class="btn-inner--icon"><i class="fa fa-trash"></i></span></button></td>'
                +  "</tr>";
        }
        $('#payments_table tbody').html(output);
    }
    function Delete(id){
        var r = confirm("Are you sure?");
        if(r){
            $.ajax({
                url: "{{route('payments.destroy')}}",
                dataType: 'json',
                type:"delete",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "payment_id" : id
                },
            success: function (response) {
                DisplayPayments(response.data);

                }
            });
            return false;
        }

    }
</script>
@endpush

