<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col">{{ __('Birth date') }}</th>
                <th scope="col">{{ __('Invoices') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beneficiaries as $beneficiary)
                <tr>
                    <td>{{ $beneficiary->fullName() }}</td>
                    <td>
                        <a href="mailto:{{$beneficiary->person_data->email}}">{{ $beneficiary->person_data->email }}</a>
                    </td>
                    <td>{{ $beneficiary->person_data->phone_number }}</td>
                    <td>{{ $beneficiary->person_data->birth_date->format('M-d-Y')}}</td>
                    <td>
                        <a  onclick="toggle_visibility({{ $beneficiary->id }});">Hide</a>
                        <div id="invoices{{$beneficiary->id}}">
                            @include('insurees.partials.invoicesTable', ['invoices' => $beneficiary->person_data->invoices])
                        </div>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer py-4">
    <nav class="d-flex justify-content-end" aria-label="...">
        {{ $beneficiaries->links() }}
    </nav>
</div>

@push('js')
<script>
    function toggle_visibility(id) {
        var e = document.getElementById("invoices"+id);
        e.style.display = ((e.style.display!='none') ? 'none' : 'block');
        }
</script>
@endpush