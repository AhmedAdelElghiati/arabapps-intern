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
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('exams.index') }}" class="btn btn-light shadow-sm text-secondary me-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="mb-0 fw-bold">Add New Exam</h4>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3">
                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                        <i class="bi bi-file-earmark-text fs-5"></i>
                    </div>
                    Exam Details
                </h5>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="{{ route('exams.index') }}" method="POST">
                    @csrf

                    <h6 class="section-title">Basic Information</h6>
                    <div class="row gy-4 mb-5">
                        <div class="col-md-8">
                            <label class="form-label fw-medium text-dark">Exam Title <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-journal-text text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="title" placeholder="e.g. Algebra Midterm" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Exam Type <span class="text-danger">*</span></label>
                            <select class="form-select" name="type" required>
                                <option value="" selected disabled>Select Type...</option>
                                <option value="Quiz">Quiz</option>
                                <option value="Homework">Homework</option>
                                <option value="Course Exam">Course Exam</option>
                                <option value="Mock Exam">Mock Exam</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Level <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <input type="text" class="form-control" name="level" placeholder="e.g. Beginner, Intermediate, Advanced">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">Status <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <select class="form-select" name="status">
                                <option value="" selected>Select Status...</option>
                                <option value="Draft">Draft</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Published">Published</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-medium text-dark">Created By <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <input type="number" class="form-control" name="created_by" placeholder="Admin ID">
                        </div>
                    </div>

                    <h6 class="section-title">Exam Configuration</h6>
                    <div class="row gy-4 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Duration <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-clock text-muted"></i></span>
                                <input type="number" step="0.01" class="form-control border-start-0 ps-0" name="duration" placeholder="e.g. 90">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Pass Marks <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-check2-circle text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0" name="passing_score" placeholder="e.g. 60">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Max Attempts <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-repeat text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0" name="allowed_tries_count" placeholder="e.g. 3">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium text-dark">Questions Number <span class="text-muted fw-normal" style="font-size: 0.8rem;">(Optional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-list-ol text-muted"></i></span>
                                <input type="number" class="form-control border-start-0 ps-0" name="questions_count" placeholder="e.g. 25">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 text-muted">

                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('exams.index') }}" class="btn btn-light border fw-medium px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 fw-medium px-4 shadow-sm">
                            <i class="bi bi-check2-circle fs-5"></i>
                            Save Exam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
