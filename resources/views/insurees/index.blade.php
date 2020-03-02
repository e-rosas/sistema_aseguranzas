@extends('layouts.app', ['title' => __('Insuree management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Insurees') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('insurees.create') }}" class="btn btn-sm btn-primary">{{ __('Add Insuree') }}</a>
                            </div>
                        </div>
                    </div>

                    <form  method="post" action="{{ route('insurees.searchIndex') }}" >
                        @csrf
                        <div class="form-group col-md-12 col-auto">
                            <label for="example-search-input" class="form-control-label">Search</label>
                            <input name="search" class="form-control" type="search" required placeholder="Search insurees..." id="search">
                        </div>
                    </form>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    {{--  Table  --}}
                    <div class="table-responsive" id="insurees_table">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Phone') }}</th>
                                    <th scope="col">{{ __('City') }}</th>
                                    <th scope="col">{{ __('Insurance ID') }}</th>
                                    <th scope="col">{{ __('Insurer') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurees as $insuree)
                                    <tr>
                                        <td>{{ $insuree->fullName() }}</td>
                                        <td>
                                            <a href="mailto:{{$insuree->person_data->email}}">{{$insuree->person_data->email}}</a>
                                        </td>
                                        <td>{{ $insuree->person_data->phone_number }}</td>
                                        <td>{{ $insuree->person_data->city }}</td>
                                        <td>{{ $insuree->insurance_id }}</td>
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
                                                        </form>   --}}   
                                                        <a class="dropdown-item" href="{{ route('insurees.show', $insuree) }}">{{ __('View') }}</a>
                                                        <a data-person="{{ $insuree->person_data->id }}" class="edit-person dropdown-item" data-toggle="modal" data-target="#modal-person_data">{{ __('Edit') }}</a> 
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $insurees->links() }}
                        </nav>
                    </div>
                      
                </div>
            </div>
        </div>
        @include('insurees.edit')
            
        @include('layouts.footers.auth')
    </div>
@endsection