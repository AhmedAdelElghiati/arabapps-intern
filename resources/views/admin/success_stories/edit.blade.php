<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">Edit Success Story</h2>
        <a href="{{ route('admin.success-stories.index') }}" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    <!-- Error Summary Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong class="d-block mb-1">Please fix the following errors:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('admin.success-stories.update', $successStory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Student Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-semibold">Student Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $successStory->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Track -->
                    <div class="col-md-6 mb-3">
                        <label for="track" class="form-label fw-semibold">Track</label>
                        <input type="text"
                               name="track"
                               id="track"
                               class="form-control @error('track') is-invalid @enderror"
                               value="{{ old('track', $successStory->track) }}">
                        @error('track')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grade -->
                    <div class="col-md-6 mb-3">
                        <label for="grade" class="form-label fw-semibold">Grade</label>
                        <input type="text"
                               name="grade"
                               id="grade"
                               class="form-control @error('grade') is-invalid @enderror"
                               value="{{ old('grade', $successStory->grade) }}">
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6 mb-3">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               name="display_order"
                               id="display_order"
                               class="form-control @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', $successStory->display_order) }}"
                               min="0">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Student Photo Upload + Current Image Preview -->
                    <div class="col-12 mb-3">
                        <label for="photo" class="form-label fw-semibold">Student Photo</label>

                        @if($successStory->photo_url)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 border rounded bg-light">
                                <img src="{{ asset('storage/' . $successStory->photo_url) }}"
                                     alt="{{ $successStory->name }}"
                                     class="rounded object-fit-cover"
                                     width="60"
                                     height="60">
                                <div>
                                    <span class="d-block fw-semibold text-dark">Current Image</span>
                                    <small class="text-muted">Uploading a new file will replace this image.</small>
                                </div>
                            </div>
                        @endif

                        <input type="file"
                               name="photo"
                               id="photo"
                               accept="image/*"
                               class="form-control @error('photo') is-invalid @enderror">
                        <small class="text-muted">Allowed formats: JPG, JPEG, PNG, WEBP (Max 2MB)</small>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description / Quote -->
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label fw-semibold">Description / Testimonial Quote</label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $successStory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Toggles -->
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_top_scored"
                                   id="is_top_scored"
                                   value="1"
                                   {{ old('is_top_scored', $successStory->is_top_scored) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_top_scored">Top Scored Student</label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', $successStory->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Active (Visible on website)</label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.success-stories.index') }}" class="btn btn-light border">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Update Story</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-admin-layout>
