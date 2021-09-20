@if($project->getMedia()->count())
    <div class="card">
        <div class="card-header">{{ 'Project media'}}</div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @foreach($project->getMedia() as $media)
                        <div class="col-6 col-md-4 col-lg-3 pb-4">
                            <img class="img-fluid" src="{{ $media->getUrl('thumb') }}">
                            @if(request()->routeIs('project.edit'))
                                @can('manageMedia', $project)
                                    <button class="btn btn-link d-block mx-auto media-remove" data-id="{{ $media->id }}"
                                            type="button">
                                        Remove file
                                    </button>
                                @endcan
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if(request()->routeIs('project.edit'))
        @can('manageMedia', $project)
            @push('scripts')
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        document.getElementsByClassName('media-remove').forEach(
                            button => button.addEventListener('click', function () {
                                fetch(`{{ route('project.remove-media', [$project->id, '']) }}/${button.dataset.id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    }
                                }).then(function () {
                                    button.parentElement.remove()
                                }).catch(function (response) {
                                    console.error(response)
                                })
                            })
                        );
                    })
                </script>
            @endpush
        @endcan
    @endif
@endif
