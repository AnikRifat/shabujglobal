<!-- resources/views/admin/pages/applications/action-buttons.blade.php -->

<!-- admin/applications/modal.blade.php -->



@if (auth()->user()->can('permission', ['update application']))
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#application{{ $application->id }}">
        View
    </button>
    <div class="modal fade" id="application{{ $application->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">{{ $application->user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $application->subject }}</h3>
                            <p>{{ $application->description }}</p>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($application->files as $item)
                                        <iframe
                                            src="https://docs.google.com/viewer?url={{ asset('storage/app/public/' . $item->file) }}&embedded=true"></iframe>
                                    @endforeach

                                </div>
                            </div>
                            <!-- Additional content or fields can be added here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endif




@if (auth()->user()->can('permission', ['update application']))
    @if ($application->status == 1)
        <a onclick="confirmAction('{{ route('admin.application.cancel', $application->id) }}','Cancel')"
            class="btn btn-warning">Cancel</a>
    @else
        <a onclick="confirmAction('{{ route('admin.application.active', $application->id) }}','Accept')"
            class="btn btn-success">Accept</a>
    @endif
@endif
@if (auth()->user()->can('permission', ['delete application']))
    <a onclick="confirmAction('{{ route('admin.application.destroy', $application->id) }}'),'Delete'"
        class="btn btn-danger">Delete</a>
@endif
