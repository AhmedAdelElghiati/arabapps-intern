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
            <div>
                <h4 class="mb-0 fw-bold">Edit Student</h4>
                <p class="text-muted mb-0" style="font-size: 0.85rem;">Updating records for: <span class="fw-semibold text-dark">{{ $student->first_name ?? 'Student' }} {{ $student->last_name ?? '' }}</span></p>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3 me-3 d-flex">
                        <i class="bi bi-pencil-square fs-5"></i>
                    </div>
                    Update Registration Details
                </h5>
            </div>

            <div class="card-body p-4 p-md-5">
                <!-- Note the route and $student->id. We also use PUT method for updates -->
                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Student Information Section -->
                    <h6 class="section-title">Student Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">First Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" placeholder="e.g. Ahmed" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Last Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" placeholder="e.g. Adel" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="email" value="{{ old('email', $student->email ?? '') }}" placeholder="student@example.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Phone Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="phone" value="{{ old('phone', $student->phone ?? '') }}" placeholder="e.g. 01012345678" required>
                            </div>
                        </div>
                    </div>

                    <!-- Parent Information Section -->
                    <h6 class="section-title">Parent/Guardian Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Parent Phone <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone ?? '') }}" placeholder="Parent's phone number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Parent Email <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 ps-0" name="parent_email" value="{{ old('parent_email', $student->parent_email ?? '') }}" placeholder="Parent's email address">
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
                                <input type="text" class="form-control border-start-0 ps-0" name="school_name" value="{{ old('school_name', $student->school_name ?? '') }}" placeholder="e.g. STEM School">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-end">
                                <label class="form-label fw-medium text-dark mb-0">Account Password</label>
                                <span class="text-muted" style="font-size: 0.75rem;">Leave blank to keep current</span>
                            </div>
                            <div class="input-group mt-2">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <!-- Password is NOT required on edit -->
                                <input type="password" class="form-control border-start-0 ps-0" name="password" placeholder="Enter new password to change">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Grade Level <span class="text-danger">*</span></label>
                            <select class="form-select" name="grade" required>
                                <option value="" disabled>Select Grade...</option>
                                <option value="Grade 10" {{ old('grade', $student->grade ?? '') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                <option value="Grade 11" {{ old('grade', $student->grade ?? '') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                <option value="Grade 12" {{ old('grade', $student->grade ?? '') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Student Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="student_type" required>
                                <option value="" disabled>Select Type...</option>
                                <option value="Online" {{ old('student_type', $student->student_type ?? '') == 'Online' ? 'selected' : '' }}>Online</option>
                                <option value="Offline" {{ old('student_type', $student->student_type ?? '') == 'Offline' ? 'selected' : '' }}>Offline</option>
                                <option value="Hybrid" {{ old('student_type', $student->student_type ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Account Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" required>
                                <option value="Active" {{ old('status', $student->status ?? '') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Pending" {{ old('status', $student->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Inactive" {{ old('status', $student->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('students.index') }}" class="btn btn-light border fw-medium px-4">Cancel</a>
                        <button type="submit" class="btn btn-warning d-flex align-items-center gap-2 fw-medium px-4 shadow-sm text-dark">
                            <i class="bi bi-save fs-5"></i>
                            Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
