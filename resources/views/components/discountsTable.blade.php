{{-- Table of discounts --}}
<div  class="table-responsive">
    <table id="services_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Percentage') }}</th>
                <th scope="col">{{ __('Discounted total') }}</th>
                <th scope="col">{{ __('Start') }}</th>
                <th scope="col">{{ __('End') }}</th>
                <th scope="col">{{ __('Days') }}</th>
                <th scope="col">{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount->discount->percentage}}</td>
                    <td>{{ $discount->discounted_total}}</td>
                    <td>{{ $discount->start_date}}</td>
                    <td>{{ $discount->end_date}}</td>
                    <td>{{ $discount->discount->amount_of_days}}</td>
                    <td>{{ $discount->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>