<!-- resources/views/admin/users/edit.blade.php -->

@extends('admin.app.app')

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($user) ? 'Edit User' : 'Create User' }}</h4>
                    <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="{{ isset($user) ? $user->name : old('name') }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">
                                @if (isset($user))
                                    update Password
                                @else
                                    New Password
                                @endif
                            </label>
                            <input type="password" name="password" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="roles">Roles:</label>
                            <select name="role" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ isset($user->role) && $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Add more fields as needed -->

                        <button type="submit"
                            class="btn btn-primary">{{ isset($user) ? 'Update User' : 'Create User' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
