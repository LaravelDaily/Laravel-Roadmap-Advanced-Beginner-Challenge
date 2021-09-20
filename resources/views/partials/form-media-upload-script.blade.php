@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let mediaUploaded = {}
            let form = document.querySelector("{{ $formId }}")
            new Dropzone(".dropzone", {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('media.upload') }}",
                addRemoveLinks: true,
                success(file, response) {
                    file.previewElement.classList.add("dz-success");
                    let input = document.createElement("input")
                    input.setAttribute("name", "media[]")
                    input.setAttribute("type", "hidden")
                    input.setAttribute("value", response.name)
                    form.appendChild(input)
                    mediaUploaded[file.name] = response.name
                },
                removedfile(file) {
                    file.previewElement.remove()
                    let name = mediaUploaded[file.name]
                    let input = form.querySelector(`input[name="media[]"][value="${name}"]`)
                    form.removeChild(input)
                }
            });
        });
    </script>
@endpush
