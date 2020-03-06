@extends('layouts.app', ['title' => __('Item Cateogry Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Item Categories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">{{ __('Add Item Category') }}</a>
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
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card">
                    <div class="row">
                            <!-- Projects table -->
                            <div class="table-responsive">
                                <table  id="categories_table" class=" table dt-responsive table-flushed table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('Name') }}</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
            
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')

    
   <script>
        $(document).ready(function() {
            var table = $('#categories_table').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: false,
                buttons: [
                    'copy', 'pdf','print', 'excel'
                ],
                ajax: {
                    url: "/allcategories",
                    dataSrc: "data",
                    type: "GET"
                },
                columns: [
                    { data: 'name' },
                ],
            });
            table.buttons().container()
                .appendTo( '#categories_table_wrapper .col-md-6:eq(0)' );
        });
    </script>
@endpush