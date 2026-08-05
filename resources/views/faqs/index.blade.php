<x-admin-layout>
    {{-- CSS الخاص بـ DataTables --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    @endpush

    <div class="card container-fluid border-0 shadow-sm rounded-4 mt-4">
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
                    <a href="{{ route('faqs.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        Add FAQ
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="faqsTable" class="table table-striped table-hover align-middle w-100 border-0">
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
                        <!-- Row 1 (Static Data) -->
                        @foreach ($faqs as $faq )
                            
                   
                        <tr>
                            <td class="fw-medium text-muted">{{ $faq->id }}</td>
                            <td class="fw-bold text-dark">{{ \Illuminate\Support\Str::limit($faq->question, 10) }}</td>
                            <td class="text-secondary">{{ \Illuminate\Support\Str::limit($faq->answer, 10) }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                                    {{ $faq->category }}
                                </span>
                            </td>
                            <td>{{ $faq->publish_date }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-3">
                                    {{ $faq->display_order }}
                                </span>
                            </td>
                          
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-light text-warning shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="{{ route('faqs.show', $faq->id) }}" class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Show">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <form action="{{ route('faqs.delete', $faq->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

               @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- JS الخاص بـ DataTables --}}
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                $('#faqsTable').DataTable({
                    pageLength: 10,
                    responsive: true,
                    columnDefs: [
                        { orderable: false, targets: -1 } // إيقاف الترتيب في عمود الإجراءات (Actions)
                    ]
                });
            });
        </script>
    @endpush
</x-admin-layout>