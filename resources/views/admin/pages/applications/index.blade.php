@extends('admin.app.app')

@section('main-content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    @endpush

    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div class="container">
                        @can('permission', ['create application'])
                            <a class="btn btn-primary" href="{{ route('admin.applications.create') }}">Create Application</a>
                        @endcan
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th> <!-- Adjusted to use the correct column name -->
                                    <th>Created At</th> <!-- Adjusted to use the correct column name -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            // Initialize DataTable
            $(document).ready(function() {
                $('#myTable').DataTable({
                    order: [],
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('datatable.applications') }}",
                    columns: [{
                            data: 'subject',
                            name: 'subject'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
