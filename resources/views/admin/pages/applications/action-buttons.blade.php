@if (auth()->user()->can('permission', ['update application']))
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#application{{ $application->id }}">
        View
    </button>
    <div class="modal fade" id="application{{ $application->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
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

                                @foreach ($application->files as $k => $item)
                                    <div class="col-md-6 text-center">
                                        <h4>file {{ $k + 1 }}</h4>
                                        <iframe
                                            src="https://docs.google.com/gview?url={{ asset('storage/app/public/' . $item->file) }}&embedded=true"
                                            style="height:500px;width:100%"></iframe>
                                        <br>
                                        <a href="" class="btn btn-warning btn-sm m-2 " target="_blank">Click
                                            to view file {{ $k + 1 }}</a>
                                    </div>
                                @endforeach


                            </div>
                            <!-- Additional content or fields can be added here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    @if (auth()->user()->can('permission', ['update application']))
                        @if ($application->status == 1)
                            <a onclick="confirmAction('{{ route('admin.application.cancel', $application->id) }}','Cancel')"
                                class="btn btn-warning" data-bs-dismiss="modal">Cancel</a>
                        @else
                            <a onclick="confirmAction('{{ route('admin.application.active', $application->id) }}','Accept')"
                                class="btn btn-success" data-bs-dismiss="modal">Accept</a>
                        @endif
                    @endif
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
