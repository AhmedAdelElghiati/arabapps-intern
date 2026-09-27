<x-admin-layout>
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 text-dark mb-0">{{ __('pages/top_students.edit.title') ?? 'Edit Success Story' }}</h2>
        <a href="{{ route('success-stories.index') }}" class="btn btn-secondary">
            {{ __('pages/top_students.edit.back_to_list') ?? 'Back to List' }}
        </a>
    </div>

    <!-- Error Summary Alert -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <strong class="d-block mb-1">{{ __('pages/top_students.messages.fix_errors') ?? 'Please fix the errors below:' }}</strong>
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
            <form action="{{ route('success-stories.update', $successStory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Translatable Fields Side by Side -->
                <div class="row mb-4">
                    <!-- English Column (LTR) -->
                    <div class="col-md-6 mb-3" dir="ltr">
                        <div class="mb-3">
                            <label for="name_en" class="form-label fw-semibold">
                                {{ __('pages/top_students.form.name') }} (English) <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name[en]"
                                   id="name_en"
                                   class="form-control @error('name.en') is-invalid @enderror"
                                   value="{{ old('name.en', $successStory->getTranslation('name', 'en', false)) }}"
                                   placeholder="e.g., Sarah Ahmed"
                                   required>
                            @error('name.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="description_en" class="form-label fw-semibold">
                                {{ __('pages/top_students.form.description') }} (English)
                            </label>
                            <textarea name="description[en]"
                                      id="description_en"
                                      rows="3"
                                      class="form-control @error('description.en') is-invalid @enderror"
                                      placeholder="e.g., Achieved top ranking nationally with 98.5% score in STEM examinations.">{{ old('description.en', $successStory->getTranslation('description', 'en', false)) }}</textarea>
                            @error('description.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Arabic Column (RTL) -->
                    <div class="col-md-6 mb-3" dir="rtl">
                        <div class="mb-3">
                            <label for="name_ar" class="form-label fw-semibold">
                                {{ __('pages/top_students.form.name') }} (بالعربية) <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name[ar]"
                                   id="name_ar"
                                   class="form-control @error('name.ar') is-invalid @enderror"
                                   value="{{ old('name.ar', $successStory->getTranslation('name', 'ar', false)) }}"
                                   placeholder="مثال: سارة أحمد"
                                   required>
                            @error('name.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="description_ar" class="form-label fw-semibold">
                                {{ __('pages/top_students.form.description') }} (بالعربية)
                            </label>
                            <textarea name="description[ar]"
                                      id="description_ar"
                                      rows="3"
                                      class="form-control @error('description.ar') is-invalid @enderror"
                                      placeholder="مثال: حصلت على المركز الأول على مستوى الجمهورية بنسبة ٩٨.٥٪ في امتحانات STEM.">{{ old('description.ar', $successStory->getTranslation('description', 'ar', false)) }}</textarea>
                            @error('description.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Non-Translatable Fields -->
                <div class="row">
                    <!-- Track -->
                    <div class="col-md-6 mb-3">
                        <label for="track" class="form-label fw-semibold">{{ __('pages/top_students.form.track') }}</label>
                        <input type="text"
                               name="track"
                               id="track"
                               class="form-control @error('track') is-invalid @enderror"
                               value="{{ old('track', $successStory->track) }}"
                               placeholder="e.g., Computer Science / Scientific">
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
                               value="{{ old('grade', $successStory->grade) }}"
                               placeholder="e.g., 98.5% or Grade 12">
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
                               value="{{ old('display_order', $successStory->display_order) }}"
                               min="0"
                               placeholder="1">
                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Photo Upload -->
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label fw-semibold">{{ __('pages/top_students.form.photo') }}</label>
                        @if($successStory->photo_url)
                            <div class="mb-2">
                                <img src="{{ Storage::url($successStory->photo_url) }}" alt="Current Photo" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
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

                    <!-- Status Toggles -->
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch pt-2">
                            <input type="hidden" name="is_top_scored" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="is_top_scored"
                                   id="is_top_scored"
                                   value="1"
                                   {{ old('is_top_scored', $successStory->is_top_scored) ? 'checked' : '' }}>
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
                                   {{ old('is_active', $successStory->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                {{ __('pages/top_students.form.is_active') }}
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('success-stories.index') }}" class="btn btn-light border">
                        {{ __('pages/top_students.edit.cancel') ?? 'Cancel' }}
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        {{ __('pages/top_students.edit.update') ?? 'Update Story' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-admin-layout>
