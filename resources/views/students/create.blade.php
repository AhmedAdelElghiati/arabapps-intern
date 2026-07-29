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
            <a href="{{ route('students.index') }}" class="btn btn-light shadow-sm text-secondary me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="mb-0 fw-bold">Add New Student</h4>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                        <i class="bi bi-person-plus-fill fs-5"></i>
                    </div>
                    Student Registration
                </h5>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="" method="POST">
                    @csrf

                    <!-- Student Information Section -->
                    <h6 class="section-title">Student Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">First Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="first_name" placeholder="e.g. Ahmed" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Last Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="last_name" placeholder="e.g. Adel" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="email" placeholder="student@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="phone" placeholder="e.g. 01012345678" required>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Information Section -->
                    <h6 class="section-title">Parent/Guardian Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Parent Phone <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="parent_phone" placeholder="Parent's phone number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Parent Email <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="parent_email" placeholder="Parent's email address">
                            </div>
                        </div>
                    </div>

                    <!-- Academic & Account Details Section -->
                    <h6 class="section-title">Academic & Account Details</h6>
                    <div class="row gy-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">School Name <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-building text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="school_name" placeholder="e.g. STEM School">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Account Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0" name="password" placeholder="Create a password" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Grade Level <span class="text-danger">*</span></label>
                            <select class="form-select" name="grade" required>
                                <option value="" selected disabled>Select Grade...</option>
                                <option value="Grade 10">Grade 10</option>
                                <option value="Grade 11">Grade 11</option>
                                <option value="Grade 12">Grade 12</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Student Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="student_type" required>
                                <option value="" selected disabled>Select Type...</option>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Account Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" required>
                                <option value="Active" selected>Active</option>
                                <option value="Pending">Pending</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('students.index') }}" class="btn btn-light border fw-medium px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 fw-medium px-4 shadow-sm">
                            <i class="bi bi-check2-circle fs-5"></i>
                            Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
