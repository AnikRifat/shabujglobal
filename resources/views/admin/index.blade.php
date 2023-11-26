@extends('admin.app.app')
@section('main-content')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Hi {{ Auth::user()->name }}! 🎉</h5>

                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('') }}assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">

                            <span class="fw-medium d-block mb-1 display-4">{{ App\Models\User::count() }} </span>
                            <h3 class="card-title mb-2">Users</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">

                            <span class="fw-medium d-block mb-1 display-4">{{ App\Models\Application::count() }} </span>
                            <h3 class="card-title mb-2">Application</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
