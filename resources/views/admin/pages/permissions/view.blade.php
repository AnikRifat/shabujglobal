@extends('admin.app.app')
@section('main-content')
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($permission) ? 'Edit Permission' : 'Create Permission' }}</h4>
                    <form
                        action="{{ isset($permission) ? route('admin.permissions.update', $permission->id) : route('admin.permissions.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($permission))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Permission Name:</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($permission) ? $permission->name : old('name') }}">
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ isset($permission) ? 'Update Permission' : 'Create Permission' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
