@extends('admin.app.app')
@section('main-content')
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('admin.permissions.create') }}">Create Permission</a>
                    <h4 class="card-title">Permission Management</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.permissions.destroy', $permission->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
