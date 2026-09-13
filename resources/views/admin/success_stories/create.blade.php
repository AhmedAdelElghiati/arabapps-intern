<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">{{ __('pages/top_students.create.title') }}</h2>
        <a href="{{ route('admin.success-stories.index') }}" class="btn btn-secondary">
            {{ __('pages/top_students.create.back_to_list') }}
        </a>
    </div>

    <!-- Error Summary Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong class="d-block mb-1">{{ __('pages/top_students.messages.fix_errors') }}</strong>
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
            <form action="{{ route('admin.success-stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Student Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-semibold">
                            {{ __('pages/top_students.form.name') }} <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="{{ __('pages/top_students.form.name_placeholder') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Track -->
                    <div class="col-md-6 mb-3">
                        <label for="track" class="form-label fw-semibold">{{ __('pages/top_students.form.track') }}</label>
                        <input type="text"
                               name="track"
                               id="track"
                               class="form-control @error('track') is-invalid @enderror"
                               value="{{ old('track') }}"
                               placeholder="{{ __('pages/top_students.form.track_placeholder') }}">
                        @error('track')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grade -->
                    <div class="col-md-6 mb-3">
                        <label for="grade" class="form-label fw-semibold">{{ __('pages/top_students.form.grade') }}</label>
                        <input type="text"
                               name="grade"
                               id="grade"
                               class="form-control @error('grade') is-invalid @enderror"
                               value="{{ old('grade') }}"
                               placeholder="{{ __('pages/top_students.form.grade_placeholder') }}">
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6 mb-3">
                        <label for="display_order" class="form-label fw-semibold">{{ __('pages/top_students.form.display_order') }}</label>
                        <input type="number"
                               name="display_order"
                               id="display_order"
                               class="form-control @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', 0) }}"
                               min="0">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Student Photo -->
                    <div class="col-12 mb-3">
                        <label for="photo" class="form-label fw-semibold">{{ __('pages/top_students.form.photo') }}</label>
                        <input type="file"
                               name="photo"
                               id="photo"
                               accept="image/*"
                               class="form-control @error('photo') is-invalid @enderror">
                        <small class="text-muted">{{ __('pages/top_students.form.photo_hint') }}</small>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description / Quote -->
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label fw-semibold">{{ __('pages/top_students.form.description') }}</label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="{{ __('pages/top_students.form.desc_placeholder') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Toggles -->
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch pt-2">
                            <input type="hidden" name="is_top_scored" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_top_scored"
                                   id="is_top_scored"
                                   value="1"
                                   {{ old('is_top_scored') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_top_scored">
                                {{ __('pages/top_students.form.is_top_scored') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch pt-2">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_active"
                                   id="is_active"
                                   value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                {{ __('pages/top_students.form.is_active') }}
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.success-stories.index') }}" class="btn btn-light border">
                        {{ __('pages/top_students.create.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        {{ __('pages/top_students.create.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-admin-layout>
