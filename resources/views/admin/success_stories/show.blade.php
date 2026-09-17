<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">{{ __('pages/top_students.show.title') ?? 'Success Story Details' }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('success-stories.edit', $successStory->id) }}" class="btn btn-warning">
                {{ __('pages/top_students.show.edit') ?? 'Edit' }}
            </a>
            <a href="{{ route('success-stories.index') }}" class="btn btn-secondary">
                {{ __('pages/top_students.show.back_to_list') ?? 'Back to List' }}
            </a>
        </div>
    </div>

    <!-- Details Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <!-- Translatable Content Side by Side -->
            <div class="row mb-4">
                <!-- English Content (LTR) -->
                <div class="col-md-6 mb-3" dir="ltr">
                    <h5 class="text-primary border-bottom pb-2 mb-3">English Content</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.name') }}</label>
                        <p class="fs-5 fw-bold text-dark mb-0">
                            {{ $successStory->getTranslation('name', 'en', false) ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.description') }}</label>
                        <p class="text-secondary bg-light p-3 rounded mb-0">
                            {{ $successStory->getTranslation('description', 'en', false) ?: '-' }}
                        </p>
                    </div>
                </div>

                <!-- Arabic Content (RTL) -->
                <div class="col-md-6 mb-3" dir="rtl">
                    <h5 class="text-primary border-bottom pb-2 mb-3">المحتوى بالعربية</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.name') }}</label>
                        <p class="fs-5 fw-bold text-dark mb-0">
                            {{ $successStory->getTranslation('name', 'ar', false) ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.description') }}</label>
                        <p class="text-secondary bg-light p-3 rounded mb-0">
                            {{ $successStory->getTranslation('description', 'ar', false) ?: '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Non-Translatable Details -->
            <div class="row g-3">
                <!-- Photo -->
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold text-muted d-block">{{ __('pages/top_students.form.photo') }}</label>
                    @if ($successStory->photo)
                        <img src="{{ Storage::url($successStory->photo) }}" alt="Student Photo" class="rounded border p-1 shadow-sm" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                    @else
                        <span class="badge bg-secondary">No Photo Uploaded</span>
                    @endif
                </div>

                <!-- Track -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.track') }}</label>
                    <p class="fw-semibold text-dark mb-0">{{ $successStory->track ?: '-' }}</p>
                </div>

                <!-- Grade -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.grade') }}</label>
                    <p class="fw-semibold text-dark mb-0">{{ $successStory->grade ?: '-' }}</p>
                </div>

                <!-- Display Order -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.display_order') }}</label>
                    <p class="fw-semibold text-dark mb-0">{{ $successStory->display_order }}</p>
                </div>

                <!-- Top Scored Status -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.is_top_scored') }}</label>
                    <div>
                        @if($successStory->is_top_scored)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </div>
                </div>

                <!-- Active Status -->
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-muted mb-1">{{ __('pages/top_students.form.is_active') }}</label>
                    <div>
                        @if($successStory->is_active)
                            <span class="badge bg-primary">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
