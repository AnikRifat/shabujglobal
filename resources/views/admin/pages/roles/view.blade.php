@extends('admin.app.app')

@section('main-content')
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name:</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($role) ? $role->name : old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions:</label>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Permission</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>

                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        {{ isset($role) && $role->hasPermissionTo($permission->id) ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ isset($role) ? 'Update Role' : 'Create Role' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
