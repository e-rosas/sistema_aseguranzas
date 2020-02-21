{{-- Table of payments --}}
<div  class="table-responsive">
    <table id="payments_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
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
                    <td>{{ $payment->comments}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $payments->links() }}
</div>
@push('js')
<script>
    $(document).ready(function(){
    
     $(document).on('click', '.page-link', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href');
        fetch_data(page);
     });
    
     function fetch_data(page)
     {
      var _token = $("input[name=_token]").val();
      $.ajax({
            url: "{{route('invoices.payments')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                "invoice_id": {{ $invoice_id }}
            },
          done:function(data)
          {
           $('#payments_table').html(data);
          }
        });
     }
    
    });
    </script>
@endpush