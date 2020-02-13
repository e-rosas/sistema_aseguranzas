@extends('layouts.app', ['title' => __('Manejo de aseguranzas')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Aseguranzas') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('aseguranzas.create') }}" class="btn btn-sm btn-primary">{{ __('Agregar aseguranza') }}</a>
                            </div>
                        </div>
                    </div>
                    
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

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Phone') }}</th>
                                    <th scope="col">{{ __('City') }}</th>
                                    <th scope="col">{{ __('ID') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aseguranzas as $aseguranza)
                                    <tr>
                                        <td>{{ $aseguranza->nombre }}</td>
                                        <td>
                                            <a href="mailto:{{ $aseguranza->correo_e }}">{{ $aseguranza->correo_e }}</a>
                                        </td>
                                        <td>{{ $aseguranza->telefono }}</td>
                                        <td>{{ $aseguranza->ciudad }}</td>
                                        <td>{{ $aseguranza->clave }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        {{--  <form action="{{ route('aseguranza.destroy', $aseguranza) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('aseguranza.edit', $aseguranza) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this aseguranza?") }}') ? this.parentElement.submit() : ''">
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
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $aseguranzas->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection