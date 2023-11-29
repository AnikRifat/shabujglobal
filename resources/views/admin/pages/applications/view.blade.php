<!-- resources/views/admin/applications/edit.blade.php -->

@extends('admin.app.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ $application ? 'Edit Application' : 'Create Application' }}</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form
                        action="{{ $application ? route('admin.application.update', $application->id) : route('admin.application.store') }}"
                        method="POST" enctype="multipart/form-data" id="applicationForm">
                        @csrf
                        @if ($application)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject"
                                value="{{ $application ? $application->subject : old('subject') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control">{{ $application ? $application->description : old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="file">Application file:</label>
                            <div id="fileInputsContainer" class="row">
                                <div class="col-md-3">
                                    <input type="file" name="files[]" data-allowed-file-extensions="pdf doc docx"
                                        accept=".pdf,.doc,.docx" class="dropify" multiple>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" id="addFileInput">Add More</button>
                        </div>

                        <!-- Add more fields as needed -->

                        <button type="submit"
                            class="btn btn-primary">{{ $application ? 'Update Application' : 'Create Application' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
        <script>
            $(document).ready(function() {
                $('.dropify').dropify();

                // Add more file input fields dynamically
                $('#addFileInput').click(function() {
                    $('#fileInputsContainer').append(
                        '<div class="col-md-3"><input type="file" name="files[]" data-allowed-file-extensions="pdf doc docx"accept = ".pdf,.doc,.docx"lass = "dropify " multiple></div>'
                    );
                    $('.dropify').dropify();
                });
            });
        </script>
    @endpush
@endsection
