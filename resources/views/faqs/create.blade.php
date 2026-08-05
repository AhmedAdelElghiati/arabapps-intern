
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
            <h4 class="mb-0 fw-bold">Add New FAQ</h4>
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
               <form action="{{ route('faqs.store') }}" method="POST">
    @csrf

    <h6 class="section-title">FAQ Information</h6>

    <div class="row gy-4 mb-5">

        <div class="col-md-12">
            <label class="form-label fw-medium text-dark">
                Question <span class="text-danger">*</span>
            </label>
            <textarea
                class="form-control"
                name="question"
                rows="3"
                placeholder="Enter question..."
                required>{{ old('question') }}</textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label fw-medium text-dark">
                Answer <span class="text-danger">*</span>
            </label>
            <textarea
                class="form-control"
                name="answer"
                rows="5"
                placeholder="Enter answer..."
                required>{{ old('answer') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium text-dark">
                Publish Date
            </label>
            <input
                type="date"
                class="form-control"
                name="publish_date"
                value="{{ old('publish_date') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium text-dark">
                Category
            </label>
            <select name="category" class="form-select">
                <option value="">Select Category</option>
                @foreach (\App\Enum\FaqsEnum::cases() as $category)
                    <option value="{{ $category->value }}" {{ old('category') === $category->value ? 'selected' : '' }}>
                            {{ $category->value }}
                        </option>
                    @endforeach
                </select>
            
        </div>

        <div class="col-md-6">
            <label class="form-label fw-medium text-dark">
                Display Order
            </label>
            <input
                type="number"
                class="form-control"
                name="display_order"
                value="{{ old('display_order') }}">
        </div>

  

    <hr class="my-4 text-muted">

    <div class="d-flex justify-content-end gap-3">
        <a href="{{ route('faqs.index') }}" class="btn btn-light border fw-medium px-4">
            Cancel
        </a>

        <button
            type="submit"
            class="btn btn-primary d-flex align-items-center gap-2 fw-medium px-4 shadow-sm">
            <i class="bi bi-check2-circle fs-5"></i>
            Save FAQ
        </button>
    </div>
</form>
            </div>
        </div>
    </div>
</x-admin-layout>
