<x-admin-layout>

    @push('styles')
        <style>
            .form-control:focus,
            .form-select:focus {
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

        {{-- Header --}}
        <div class="d-flex align-items-center mb-4">

            <a href="{{ route('faqs.index') }}"
                class="btn btn-light shadow-sm text-secondary me-3 rounded-circle d-flex align-items-center justify-content-center"
                style="width: 40px; height: 40px;">

                <i class="bi bi-arrow-left"></i>

            </a>

            <h4 class="mb-0 fw-bold">
                {{ __('messages.update_faq') }}
            </h4>

        </div>


        <div class="card border-0 shadow-sm rounded-4">

            {{-- Card Header --}}
            <div class="card-header bg-white border-bottom py-3">

                <h5 class="card-title mb-0 d-flex align-items-center fw-bold text-dark">

                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">

                        <i class="bi bi-file-earmark-text fs-5"></i>

                    </div>

                    {{ __('messages.faq_details') }}

                </h5>

            </div>


            {{-- Card Body --}}
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('faqs.update', $faq->id) }}" method="POST">

                    @csrf

                    @method('PUT')


                    <h6 class="section-title">
                        {{ __('messages.faq_information') }}
                    </h6>


                    <div class="row gy-4 mb-5">

                        {{-- Question --}}
                        <div class="col-md-6">

                            <label class="form-label fw-medium text-dark">

                                {{ __('messages.question') }} (English)
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                class="form-control @error('question.en') is-invalid @enderror"
                                name="question[en]"
                                rows="3"
                                placeholder="{{ __('messages.enter_question') }}"
                                required>{{ old('question.en', $faq->getTranslation('question', 'en', false)) }}</textarea>

                            @error('question.en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Answer --}}
                        <div class="col-md-6">

                            <label class="form-label fw-medium text-dark">

                                {{ __('messages.question') }} (Arabic)
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                class="form-control @error('question.ar') is-invalid @enderror"
                                name="question[ar]"
                                rows="3"
                                placeholder="{{ __('messages.enter_question') }}"
                                required>{{ old('question.ar', $faq->getTranslation('question', 'ar', false)) }}</textarea>

                            @error('question.ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">{{ __('messages.answer') }} (English) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('answer.en') is-invalid @enderror" name="answer[en]" rows="5" required>{{ old('answer.en', $faq->getTranslation('answer', 'en', false)) }}</textarea>
                            @error('answer.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">{{ __('messages.answer') }} (Arabic) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('answer.ar') is-invalid @enderror" name="answer[ar]" rows="5" required>{{ old('answer.ar', $faq->getTranslation('answer', 'ar', false)) }}</textarea>
                            @error('answer.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>


                        {{-- Publish Date --}}
                        <div class="col-md-6">

                            <label class="form-label fw-medium text-dark">
                                {{ __('messages.publish_date') }}
                            </label>

                            <input
                                type="date"
                                class="form-control @error('publish_date') is-invalid @enderror"
                                name="publish_date"
                                value="{{ old('publish_date', $faq->publish_date) }}">

                            @error('publish_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Category --}}
                        <div class="col-md-6">

                            <label class="form-label fw-medium text-dark">
                                {{ __('messages.category') }}
                            </label>

                            <select
                                name="category[en]"
                                                       class="form-select @error('category.en') is-invalid @enderror">

                                <option value="">
                                    {{ __('messages.select_category') }}
                                </option>

                                @foreach (\App\Enum\FaqsEnum::cases() as $category)

                                    <option
                                        value="{{ $category->value }}"
                                        @selected(old('category.en', $faq->getTranslation('category', 'en', false)) === $category->value)>

                                        {{ $category->value }}

                                    </option>

                                @endforeach

                            </select>

                            @error('category.en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-medium text-dark">{{ __('messages.category') }} (Arabic)</label>
                            <input type="text" name="category[ar]" value="{{ old('category.ar', $faq->getTranslation('category', 'ar', false)) }}"
                                class="form-control @error('category.ar') is-invalid @enderror">
                            @error('category.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>


                        {{-- Display Order --}}
                        <div class="col-md-6">

                            <label class="form-label fw-medium text-dark">

                                {{ __('messages.display_order') }}
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="number"
                                class="form-control @error('display_order') is-invalid @enderror"
                                name="display_order"
                                value="{{ old('display_order', $faq->display_order) }}"
                                required>

                            @error('display_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <hr class="my-4 text-muted">


                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-3">

                        <a
                            href="{{ route('faqs.index') }}"
                            class="btn btn-light border fw-medium px-4">

                            {{ __('messages.cancel') }}

                        </a>


                        <button
                            type="submit"
                            class="btn btn-primary d-flex align-items-center gap-2 fw-medium px-4 shadow-sm">

                            <i class="bi bi-check2-circle fs-5"></i>

                            {{ __('messages.update_faq') }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-admin-layout>