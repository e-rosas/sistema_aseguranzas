<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Total') }}</th>
                <th scope="col">{{ __('Total with discounts') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td><a  href="{{ route('invoices.show', $invoice) }}">{{ $invoice->number }}</a></td>
                    <td>{{ $invoice->date->format('M-d-Y') }}</td>
                    <td>{{ $invoice->total }}</td>
                    <td>{{ $invoice->total_with_discounts }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>