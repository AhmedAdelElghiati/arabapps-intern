<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="app-page-title">Edit Gallery Item</h1>
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
                    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $gallery->title) }}"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="img_url" class="form-label">Image URL <span class="text-danger">*</span></label>
                            <input 
                                type="url" 
                                id="img_url" 
                                name="img_url" 
                                class="form-control @error('img_url') is-invalid @enderror"
                                value="{{ old('img_url', $gallery->img_url) }}"
                                required
                            >
                            @error('img_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Enter a valid URL to an image file</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <br>
                            <img id="preview-image" src="{{ old('img_url', $gallery->img_url) }}" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>

                        <div class="d-flex gap-2">
                            <button 
                                type="submit" 
                                class="btn btn-primary"
                            >
                                <i class="bi bi-check-circle me-2"></i> Update Gallery Item
                            </button>
                            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_url').addEventListener('change', function(e) {
            const url = e.target.value;
            const preview = document.getElementById('preview-image');
            
            if (url) {
                preview.src = url;
                preview.onerror = function() { this.style.display = 'none'; };
                preview.style.display = 'block';
            }
        });
    </script>
</x-admin-layout>
