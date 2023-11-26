@extends('admin.app.app')
@section('main-content')
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    @endpush
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Create User</a>

                    <div class="container">
                        <table id="myTable" class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <!-- Add more columns as needed -->
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
                    ajax: "{{ route('datatable.users') }}", // Add the route to fetch data dynamically
                    columns: [{
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },
                        // Add more columns as needed
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
