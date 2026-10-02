<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">{{ __('pages/galleries.edit.title') }}</h1>
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
                    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('pages/galleries.fields.title') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $gallery->getTranslation('title', app()->getLocale())) }}"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('pages/galleries.fields.image') }}</label>
                            <input type="file" id="image" name="image"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">{{ __('pages/galleries.messages.type') }}</small>
                        </div>

                        <div class="mb-3" id="preview-container"
                            style="{{ $gallery->image ? 'display:block;' : 'display:none;' }}">
                            <label class="form-label">{{ __('pages/galleries.actions.preview') }}</label>
                            <br>
                            <img id="preview-image"
                                src="{{ $gallery->image ? asset('storage/' . $gallery->image) : '' }}" alt="Preview"
                                class="img-thumbnail" style="max-width: 200px;">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i> {{ __('pages/galleries.edit.submit') }}
                            </button>
                            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i> {{ __('pages/galleries.edit.cancel') }}
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

            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');

            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewContainer.style.display = 'block';
            } else {
                const existing = "{{ $gallery->image ? asset('storage/' . $gallery->image) : '' }}";
                if (existing) {
                    previewImage.src = existing;
                    previewContainer.style.display = 'block';
                } else {
                    previewImage.src = '';
                    previewContainer.style.display = 'none';
                }
            }
        });
    </script>
</x-admin-layout>
