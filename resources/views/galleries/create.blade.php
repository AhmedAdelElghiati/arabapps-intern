<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">{{ __('pages/galleries.create.title') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Validation Errors</h4>

                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                {{ __('pages/galleries.fields.title') }} <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                {{ __('pages/galleries.fields.image') }} <span class="text-danger">*</span>
                            </label>

                            <input type="file" id="image" name="image"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="form-control @error('image') is-invalid @enderror" required>

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <small class="form-text text-muted">
                                {{ __('pages/galleries.messages.type') }}.
                            </small>
                        </div>

                        {{-- Image Preview --}}
                        <div class="mb-3" id="preview-container" style="display: none;">
                            <label class="form-label">Preview</label>

                            <br>

                            <img id="preview-image" src="" alt="Image Preview" class="img-thumbnail mt-2"
                                style="max-width: 200px;">
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ __('pages/galleries.create.submit') }}
                            </button>

                            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>
                                {{ __('pages/galleries.create.cancel') }}
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];

            const previewContainer =
                document.getElementById('preview-container');

            const previewImage =
                document.getElementById('preview-image');

            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewContainer.style.display = 'block';
            } else {
                previewImage.src = '';
                previewContainer.style.display = 'none';
            }
        });
    </script>
</x-admin-layout>
