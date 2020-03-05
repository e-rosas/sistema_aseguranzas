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
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    {{--  <form action="{{ route('service.destroy', $service) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        
                                        <a class="dropdown-item" href="{{ route('service.edit', $service) }}">{{ __('Edit') }}</a>
                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this service?") }}') ? this.parentElement.submit() : ''">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>    --}}  
                                    <a data-call="{{ $call->id }}"  class="update-call dropdown-item" data-toggle="modal" data-target="#modal-update-call">{{ __('Edit') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>