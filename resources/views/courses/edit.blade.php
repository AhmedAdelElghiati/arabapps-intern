<x-admin-layout>
    @push('styles')
        <style>
            .form-control:focus, .form-select:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
            .section-title {
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                color: #6c757d;
                font-weight: 600;
                margin-bottom: 1rem;
                border-bottom: 1px solid #e9ecef;
                padding-bottom: 0.5rem;
            }
        </style>
    @endpush

    <div class="container-fluid mt-4 mb-5">
        <!-- Header & Back Button -->
        <div class="d-flex align-items-center mb-4">
            <a href="/courses" class="btn btn-light shadow-sm text-secondary me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="mb-0 fw-bold">Edit Course</h4>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">Updating records for: <span class="fw-semibold text-dark">{{ $course->title ?? 'Course' }}</span></p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3 me-3 d-flex">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    Update Course Details
                </h5>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="/courses/{{ $course->id ?? '' }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Course Information Section -->
                    <h6 class="section-title">Basic Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-8">
                            <label class="form-label fw-medium text-dark">Course Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-book text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="title" value="{{ old('title', $course->title ?? '') }}" placeholder="e.g. Advanced Mathematics" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Level <span class="text-danger">*</span></label>
                            <select class="form-select" name="level" required>
                                <option value="" disabled>Select Level...</option>
                                <option value="Beginner" {{ old('level', $course->level ?? '') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('level', $course->level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('level', $course->level ?? '') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-medium text-dark">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Briefly describe the course content..." required>{{ old('description', $course->description ?? '') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Image URL <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-image text-muted"></i></span>
                                <input type="url" class="form-control border-start-0 ps-0" name="image_url" value="{{ old('image_url', $course->image_url ?? '') }}" placeholder="https://example.com/image.jpg" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Course Material <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Leave blank to keep current)</span></label>
                            <input class="form-control" type="file" name="material_file" id="courseMaterial">
                        </div>
                    </div>

                    <!-- Pricing & Duration Section -->
                    <h6 class="section-title">Pricing & Duration</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-3">
                            <label class="form-label fw-medium text-dark">Duration (Days) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3 text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0" name="duration" value="{{ old('duration', $course->duration ?? '') }}" placeholder="e.g. 30" required>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end pb-2">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="isFreeSwitch" name="is_free" value="1" {{ old('is_free', $course->is_free ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2 fw-medium text-dark" style="font-size: 0.95rem; margin-top: 4px;" for="isFreeSwitch">Is Free?</label>
                            </div>
                        </div>

                        <div class="col-md-3 pricing-field" id="priceCol">
                            <label class="form-label fw-medium text-dark">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-currency-dollar text-muted"></i></span>
                                <input type="number" step="0.01" min="0" class="form-control border-start-0 ps-0" name="price" value="{{ old('price', $course->price ?? '0') }}" placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-md-3 pricing-field" id="discountCol">
                            <label class="form-label fw-medium text-dark">Discount</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag text-muted"></i></span>
                                <input type="number" step="0.01" min="0" class="form-control border-start-0 ps-0" name="discount" value="{{ old('discount', $course->discount ?? '0') }}" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <!-- Display & Settings Section -->
                    <h6 class="section-title">Settings & Publishing</h6>
                    <div class="row gy-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Display Order <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-sort-numeric-down text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0" name="display_order" value="{{ old('display_order', $course->display_order ?? '1') }}" placeholder="e.g. 1" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Publish Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-clock text-muted"></i></span>
                                <input type="datetime-local" class="form-control border-start-0 ps-0" name="publish_date" value="{{ old('publish_date', isset($course->publish_date) ? date('Y-m-d\TH:i', strtotime($course->publish_date)) : '') }}">
                            </div>
                        </div>

                        <div class="col-md-4 d-flex flex-column justify-content-center pt-3 gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="desmosSwitch" name="is_desmos_enabled" value="1" {{ old('is_desmos_enabled', $course->is_desmos_enabled ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2 fw-medium text-dark" for="desmosSwitch">Enable Desmos Calculator</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="homeSwitch" name="show_at_home" value="1" {{ old('show_at_home', $course->show_at_home ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2 fw-medium text-dark" for="homeSwitch">Show on Home Page</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="publishSwitch" name="is_published" value="1" {{ old('is_published', $course->is_published ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2 fw-medium text-dark" for="publishSwitch">Publish Course</label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="/courses" class="btn btn-light border fw-medium px-4">Cancel</a>
                        <button type="submit" class="btn btn-warning d-flex align-items-center gap-2 fw-medium px-4 shadow-sm text-dark">
                            <i class="bi bi-save fs-5"></i>
                            Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const isFreeSwitch = document.getElementById('isFreeSwitch');
                const priceCol = document.getElementById('priceCol');
                const discountCol = document.getElementById('discountCol');

                const priceInput = document.querySelector('input[name="price"]');
                const discountInput = document.querySelector('input[name="discount"]');

                function togglePricingVisibility() {
                    if (isFreeSwitch.checked) {
                        priceCol.classList.add('d-none');
                        discountCol.classList.add('d-none');

                        // Set values to 0 when marked as free
                        priceInput.value = 0;
                        discountInput.value = 0;

                        priceInput.removeAttribute('required');
                    } else {
                        priceCol.classList.remove('d-none');
                        discountCol.classList.remove('d-none');
                        priceInput.setAttribute('required', 'required');
                    }
                }

                // Run on initial load to match the existing course status
                togglePricingVisibility();

                // Run whenever the switch is toggled
                isFreeSwitch.addEventListener('change', togglePricingVisibility);
            });
        </script>
    @endpush
</x-admin-layout>
