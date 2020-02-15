<div class="pl-lg-4">
    <form>
        <div class="input-group mb-4">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
            </div>
            <input class="form-control" placeholder="Insuree" type="text" id="searchInsuree" name="search" value="">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
    {{--  Table  --}}
    <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Phone') }}</th>
                    <th scope="col">{{ __('City') }}</th>
                    <th scope="col">{{ __('Insurance') }}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insurees as $insuree)
                    <tr>
                        <td>{{ $insuree->fullName() }}</td>
                        <td>
                            <a href="mailto:{{ $insuree->person_data->email }}">{{ $insuree->person_data->email }}</a>
                        </td>
                        <td>{{ $insuree->person_data->phone_number }}</td>
                        <td>{{ $insuree->person_data->city }}</td>
                        <td>{{ $insuree->insurer->name }}</td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        {{--  <form action="{{ route('insuree.destroy', $insuree) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                            <a class="dropdown-item" href="{{ route('insuree.edit', $insuree) }}">{{ __('Edit') }}</a>
                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this insuree?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>    --}}  
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>