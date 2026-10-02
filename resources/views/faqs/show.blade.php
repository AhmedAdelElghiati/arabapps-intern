<x-admin-layout>
    <div class="container-fluid py-4">
        
        {{-- Header Section --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center gy-3">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0 d-flex align-items-center fw-bold">
                            <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                                <i class="bi bi-question-circle-fill fs-5"></i>
                            </div>
                            {{ __('messages.faq_details') }}
                        </h4>
                    </div>

                    <div class="col-md-6 d-flex justify-content-md-end align-items-center gap-2">

                        {{-- زر العودة للقائمة --}}
                        <a href="{{ route('faqs.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 fw-medium">
                            <i class="bi bi-arrow-right"></i>
                            {{ __('messages.back_to_faqs_list') }}
                        </a>

                        {{-- زر التعديل --}}
                        <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-warning text-white d-flex align-items-center gap-2 px-3 fw-medium">
                            <i class="bi bi-pencil-fill"></i>
                            {{ __('messages.edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Single FAQ Card --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">

                {{-- Badges Header --}}
                <div class="d-flex flex-wrap align-items-center gap-2 mb-4 pb-3 border-bottom">
                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold">
                        #{{ __('messages.id') }}: {{ $faq->id }}
                    </span>

                    @if($faq->getTranslation('category', app()->getLocale(), true))
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                            <i class="bi bi-tag-fill me-1"></i>
                            {{ __('messages.category') }}: {{ $faq->getTranslation('category', app()->getLocale(), true) }}
                        </span>
                    @endif

                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-sort-numeric-down me-1"></i>
                        {{ __('messages.display_order') }}: {{ $faq->display_order ?? 0 }}
                    </span>
                </div>

                {{-- Question --}}
                <div class="mb-4">
                    <label class="text-muted small fw-bold text-uppercase mb-2">
                        {{ __('messages.question') }} :
                    </label>

                    <h3 class="fw-bold text-dark lh-base">
                        <i class="bi bi-patch-question-fill text-primary me-2"></i>
                        {{ $faq->getTranslation('question', app()->getLocale(), true) }}
                    </h3>
                </div>

                {{-- Answer --}}
                <div class="mb-4 bg-light p-4 rounded-3 border-start border-primary border-4">
                    <label class="text-muted small fw-bold text-uppercase mb-2">
                        {{ __('messages.answer') }} :
                    </label>

                    <p class="text-dark mb-0 fs-5 lh-lg" style="white-space: pre-line;">
                        {{ $faq->getTranslation('answer', app()->getLocale(), true) }}
                    </p>
                </div>

                <hr class="my-4 text-muted opacity-25">

                {{-- Meta Information Footer --}}
                <div class="row g-3 text-muted">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle fs-5 text-secondary"></i>
                            <div>
                                <span class="d-block small">
                                    {{ __('messages.created_by') }}
                                </span>

                                <strong class="text-dark">
                                    {{ $faq->created_by ?? __('messages.system') }}
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-2 justify-content-md-end">
                            <i class="bi bi-calendar-event fs-5 text-secondary"></i>
                            <div>
                                <span class="d-block small">
                                    {{ __('messages.publish_date') }}
                                </span>

                                <strong class="text-dark">
                                    {{ $faq->publish_date ?? __('messages.empty_value') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-admin-layout>