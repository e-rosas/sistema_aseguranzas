{{-- Table of calls --}}
<div  class="table-responsive">
    <table id="calls_table" class="table align-services-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Number') }}</th>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Claim') }}</th>
                <th scope="col">{{ __('Comments') }}</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calls as $call)
                <tr>
                    <td>{{ $call->number}}</td>
                    <td>{{ $call->date->format('M-d-Y')}}</td>
                    <td>{{ $call->claim}}</td>
                    <td>{{ $call->comments}}</td>
                    <td class="text-right">
                        <button class="btn btn-icon btn-outline-warning btn-sm"  type="button" onClick="showEditCallModal({{ $call->id }})">
                            <span class="btn-inner--icon">
                                <i class="fas fa-edit"></i>
                            </span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>