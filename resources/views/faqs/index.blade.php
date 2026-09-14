{{-- <x-admin-layout>

    @push('styles')
        <style>
            .form-control:focus,
            .form-select:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
        </style>
    @endpush

    <div class="card container-fluid border-0 shadow-sm rounded-4 mt-4">

       
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
                </button>
            </div>
        @endif

    
        <div class="card-header bg-white border-bottom py-3">

            <div class="row align-items-center gy-3">

                <div class="col-md-5">

                    <h4 class="card-title mb-0 d-flex align-items-center fw-bold">

                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                            <i class="bi bi-question-circle-fill fs-5"></i>
                        </div>

                        FAQs List

                    </h4>

                </div>

                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-3">

                  
                    <form action="{{ route('faqs.index') }}" method="GET" class="d-flex gap-2">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search FAQs..."
                            value="{{ request('search') }}"
                            style="width: 250px;"
                        >

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search'))
                            <a
                                href="{{ route('faqs.index') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-x-lg"></i>

                            </a>
                        @endif

                    </form>

                    <a
                        href="{{ route('faqs.create') }}"
                        class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">

                        <i class="bi bi-plus-lg"></i>

                        Add FAQ

                    </a>

                </div>

            </div>

        </div>


      
        <div class="card-body p-3">

            <div class="table-responsive">

                <table
                    id="faqsTable"
                    class="table table-striped table-hover align-middle w-100 border-0">

                    <thead class="table-light text-secondary">

                        <tr>

                            <th>ID</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Category</th>
                            <th>Publish Date</th>
                            <th>Display Order</th>
                            <th class="text-center">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($faqs as $faq)

                            <tr>

                              
                                <td class="fw-medium text-muted">
                                    {{ $faq->id }}
                                </td>


                                
                                <td class="fw-bold text-dark">
                                    {{ \Illuminate\Support\Str::limit($faq->question, 10) }}
                                </td>


                              
                                <td class="text-secondary">
                                    {{ \Illuminate\Support\Str::limit($faq->answer, 10) }}
                                </td>


                                
                                <td>

                                    @if($faq->category)

                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">

                                            {{ $faq->category->value }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            --
                                        </span>

                                    @endif

                                </td>


                              
                                <td>
                                    {{ $faq->publish_date ?? '--' }}
                                </td>


                                
                                <td>

                                    <span
                                        class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-3">

                                        {{ $faq->display_order }}

                                    </span>

                                </td>


                                
                                <td>

                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                       
                                        <a
                                            href="{{ route('faqs.edit', $faq->id) }}"
                                            class="btn btn-sm btn-light text-warning shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px;"
                                            title="Edit">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>


                                      
                                        <a
                                            href="{{ route('faqs.show', $faq->id) }}"
                                            class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px;"
                                            title="Show">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>


                                    
                                        <form
                                            action="{{ route('faqs.delete', $faq->id) }}"
                                            method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this FAQ?');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 34px; height: 34px;"
                                                title="Delete">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4 text-muted">

                                    @if(request('search'))

                                        No FAQs found for:
                                        <strong>{{ request('search') }}</strong>

                                    @else

                                        No FAQs found.

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


           
            @if($faqs->hasPages())

                <div class="d-flex justify-content-end mt-3">

                    <nav>

                        <ul class="pagination mb-0">

                          
                            @if($faqs->onFirstPage())

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        Previous
                                    </span>

                                </li>

                            @else

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->previousPageUrl() }}">

                                        Previous

                                    </a>

                                </li>

                            @endif


                       
                            @for ($page = 1; $page <= $faqs->lastPage(); $page++)

                                <li
                                    class="page-item {{ $faqs->currentPage() == $page ? 'active' : '' }}">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->url($page) }}">

                                        {{ $page }}

                                    </a>

                                </li>

                            @endfor


                            
                            @if($faqs->hasMorePages())

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->nextPageUrl() }}">

                                        Next

                                    </a>

                                </li>

                            @else

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        Next
                                    </span>

                                </li>

                            @endif

                        </ul>

                    </nav>

                </div>

            @endif

        </div>

    </div>

</x-admin-layout> --}}
<x-admin-layout>

    @push('styles')
        <style>
            .form-control:focus,
            .form-select:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
        </style>
    @endpush

    <div class="card container-fluid border-0 shadow-sm rounded-4 mt-4">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
                </button>
            </div>
        @endif

        {{-- Header --}}
        <div class="card-header bg-white border-bottom py-3">

            <div class="row align-items-center gy-3">

                <div class="col-md-5">

                    <h4 class="card-title mb-0 d-flex align-items-center fw-bold">

                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                            <i class="bi bi-question-circle-fill fs-5"></i>
                        </div>

                        {{ __('messages.faqs_list') }}

                    </h4>

                </div>

                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-3">

                    {{-- Search --}}
                    <form action="{{ route('faqs.index') }}" method="GET" class="d-flex gap-2">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="{{ __('messages.search_faqs') }}"
                            value="{{ request('search') }}"
                            style="width: 250px;"
                        >

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search'))
                            <a
                                href="{{ route('faqs.index') }}"
                                class="btn btn-secondary">

                                <i class="bi bi-x-lg"></i>

                            </a>
                        @endif

                    </form>

                    {{-- Add FAQ --}}
                    <a
                        href="{{ route('faqs.create') }}"
                        class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">

                        <i class="bi bi-plus-lg"></i>

                        {{ __('messages.add_faq') }}

                    </a>

                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="card-body p-3">

            <div class="table-responsive">

                <table
                    id="faqsTable"
                    class="table table-striped table-hover align-middle w-100 border-0">

                    <thead class="table-light text-secondary">

                        <tr>

                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.question') }}</th>
                            <th>{{ __('messages.answer') }}</th>
                            <th>{{ __('messages.category') }}</th>
                            <th>{{ __('messages.publish_date') }}</th>
                            <th>{{ __('messages.display_order') }}</th>
                            <th class="text-center">{{ __('messages.actions') }}</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($faqs as $faq)

                            <tr>

                                {{-- ID --}}
                                <td class="fw-medium text-muted">
                                    {{ $faq->id }}
                                </td>


                                {{-- Question --}}
                                <td class="fw-bold text-dark">
                                    {{ \Illuminate\Support\Str::limit($faq->question, 10) }}
                                </td>


                                {{-- Answer --}}
                                <td class="text-secondary">
                                    {{ \Illuminate\Support\Str::limit($faq->answer, 10) }}
                                </td>


                                {{-- Category --}}
                                <td>

                                    @if($faq->category)

                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">

                                            {{ $faq->category->value }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            {{ __('messages.empty_value') }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Publish Date --}}
                                <td>
                                    {{ $faq->publish_date ?? __('messages.empty_value') }}
                                </td>


                                {{-- Display Order --}}
                                <td>

                                    <span
                                        class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-3">

                                        {{ $faq->display_order }}

                                    </span>

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex justify-content-center align-items-center gap-2">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('faqs.edit', $faq->id) }}"
                                            class="btn btn-sm btn-light text-warning shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px;"
                                            title="{{ __('messages.edit') }}">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>


                                        {{-- Show --}}
                                        <a
                                            href="{{ route('faqs.show', $faq->id) }}"
                                            class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px;"
                                            title="{{ __('messages.show') }}">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('faqs.delete', $faq->id) }}"
                                            method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('{{ __('messages.are_you_sure_delete_faq') }}');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 34px; height: 34px;"
                                                title="{{ __('messages.delete') }}">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4 text-muted">

                                    @if(request('search'))

                                        {{ __('messages.no_faqs_found_for') }}
                                        <strong>{{ request('search') }}</strong>

                                    @else

                                        {{ __('messages.no_faqs_found') }}

                                    @endif

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($faqs->hasPages())

                <div class="d-flex justify-content-end mt-3">

                    <nav>

                        <ul class="pagination mb-0">

                            {{-- Previous --}}
                            @if($faqs->onFirstPage())

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        {{ __('messages.previous') }}
                                    </span>

                                </li>

                            @else

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->previousPageUrl() }}">

                                        {{ __('messages.previous') }}

                                    </a>

                                </li>

                            @endif


                            {{-- Page Numbers --}}
                            @for ($page = 1; $page <= $faqs->lastPage(); $page++)

                                <li
                                    class="page-item {{ $faqs->currentPage() == $page ? 'active' : '' }}">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->url($page) }}">

                                        {{ $page }}

                                    </a>

                                </li>

                            @endfor


                            {{-- Next --}}
                            @if($faqs->hasMorePages())

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $faqs->nextPageUrl() }}">

                                        {{ __('messages.next') }}

                                    </a>

                                </li>

                            @else

                                <li class="page-item disabled">

                                    <span class="page-link">
                                        {{ __('messages.next') }}
                                    </span>

                                </li>

                            @endif

                        </ul>

                    </nav>

                </div>

            @endif

        </div>

    </div>

</x-admin-layout>