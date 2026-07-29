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
            <h4 class="mb-0 fw-bold">Add New Course</h4>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                        <i class="bi bi-journal-plus fs-5"></i>
                    </div>
                    Course Details
                </h5>
            </div>

            <div class="card-body p-4 p-md-5">
                <!-- Added enctype="multipart/form-data" for file uploads -->
                <form action="/courses" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Course Information Section -->
                    <h6 class="section-title">Basic Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-8">
                            <label class="form-label fw-medium text-dark">Course Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-book text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="title" placeholder="e.g. Advanced Mathematics" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Level <span class="text-danger">*</span></label>
                            <select class="form-select" name="level" required>
                                <option value="" selected disabled>Select Level...</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-medium text-dark">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Briefly describe the course content..." required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Image URL <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-image text-muted"></i></span>
                                <input type="url" class="form-control border-start-0 ps-0" name="image_url" placeholder="https://example.com/image.jpg" required>
                            </div>
                        </div>

                        <!-- New Course Material Upload Field -->
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Course Material <span class="text-muted fw-normal" style="font-size: 0.8rem;">(PDF, ZIP, etc. - Optional)</span></label>
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
                                <input type="number" class="form-control border-start-0 ps-0" name="duration" placeholder="e.g. 30" required>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end pb-2">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="isFreeSwitch" name="is_free" value="1">
                                <label class="form-check-label ms-2 fw-medium text-dark" style="font-size: 0.95rem; margin-top: 4px;" for="isFreeSwitch">Is Free?</label>
                            </div>
                        </div>

                        <!-- Assigned an ID to easily target and hide/show these columns via JS -->
                        <div class="col-md-3 pricing-field" id="priceCol">
                            <label class="form-label fw-medium text-dark">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-currency-dollar text-muted"></i></span>
                                <input type="number" step="0.01" min="0" class="form-control border-start-0 ps-0" name="price" placeholder="0.00" value="0">
                            </div>
                        </div>

                        <div class="col-md-3 pricing-field" id="discountCol">
                            <label class="form-label fw-medium text-dark">Discount</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-tag text-muted"></i></span>
                                <input type="number" step="0.01" min="0" class="form-control border-start-0 ps-0" name="discount" placeholder="0.00" value="0">
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
                                <input type="number" class="form-control border-start-0 ps-0" name="display_order" placeholder="e.g. 1" value="1" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Publish Date</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-clock text-muted"></i></span>
                                <input type="datetime-local" class="form-control border-start-0 ps-0" name="publish_date">
                            </div>
                        </div>

                        <div class="col-md-4 d-flex flex-column justify-content-center pt-3 gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="desmosSwitch" name="is_desmos_enabled" value="1">
                                <label class="form-check-label ms-2 fw-medium text-dark" for="desmosSwitch">Enable Desmos Calculator</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="homeSwitch" name="show_at_home" value="1">
                                <label class="form-check-label ms-2 fw-medium text-dark" for="homeSwitch">Show on Home Page</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="publishSwitch" name="is_published" value="1">
                                <label class="form-check-label ms-2 fw-medium text-dark" for="publishSwitch">Publish Course</label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="/courses" class="btn btn-light border fw-medium px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 fw-medium px-4 shadow-sm">
                            <i class="bi bi-check2-circle fs-5"></i>
                            Save Course
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

                // Function to toggle visibility of pricing fields
                function togglePricingVisibility() {
                    if (isFreeSwitch.checked) {
                        priceCol.classList.add('d-none');
                        discountCol.classList.add('d-none');

                        // Optionally reset values to 0 when marked as free
                        priceInput.value = 0;
                        discountInput.value = 0;

                        // Remove required attribute just in case
                        priceInput.removeAttribute('required');
                    } else {
                        priceCol.classList.remove('d-none');
                        discountCol.classList.remove('d-none');
                        priceInput.setAttribute('required', 'required');
                    }
                }

                // Run on initial load in case the switch was preserved across redirects
                togglePricingVisibility();

                // Run whenever the switch is clicked
                isFreeSwitch.addEventListener('change', togglePricingVisibility);
            });
        </script>
    @endpush
</x-admin-layout>
