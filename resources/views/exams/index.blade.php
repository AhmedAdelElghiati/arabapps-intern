<x-admin-layout>
    @include('components.admin.partials.tabulator')

    <div class="card container-fluid border-0 shadow-sm rounded-4 mt-4">
        <div class="card-header bg-white border-bottom py-3">
            <div class="row align-items-center gy-3">
                <div class="col-md-5">
                    <h4 class="card-title mb-0 d-flex align-items-center fw-bold">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                            <i class="bi bi-file-earmark-text-fill fs-5"></i>
                        </div>
                        Exams
                    </h4>
                </div>

                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-3">
                    <div class="input-group" style="max-width: 320px;">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Search exams...">
                    </div>

                    <a href="{{ route('exams.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        Add Exam
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div id="examsTable" class="border-0"></div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const exams = [
                    {
                        id: 1001,
                        title: "Algebra Midterm",
                        type: "Course Exam",
                        passMarks: "60",
                        maxAttempts: "3",
                        questionsNumber: "25",
                        status: "Scheduled",
                        statusColor: "primary"
                    },
                    {
                        id: 1002,
                        title: "Physics Quiz",
                        type: "Quiz",
                        passMarks: "50",
                        maxAttempts: "2",
                        questionsNumber: "10",
                        status: "Draft",
                        statusColor: "warning"
                    },
                    {
                        id: 1003,
                        title: "English Final",
                        type: "Mock Exam",
                        passMarks: "70",
                        maxAttempts: "1",
                        questionsNumber: "40",
                        status: "Published",
                        statusColor: "success"
                    },
                    {
                        id: 1004,
                        title: "History Assessment",
                        type: "Homework",
                        passMarks: "55",
                        maxAttempts: "4",
                        questionsNumber: "15",
                        status: "Archived",
                        statusColor: "secondary"
                    }
                ];

                new Tabulator("#examsTable", {
                    data: exams,
                    layout: "fitColumns",
                    pagination: true,
                    paginationSize: 10,
                    movableColumns: true,
                    rowHeight: 70,
                    columns: [
                        {
                            title: "ID",
                            field: "id",
                            width: 90,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter: function(cell) {
                                return `<span class="text-muted fw-medium">#${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Exam",
                            field: "title",
                            minWidth: 240,
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `
                                    <div class="d-flex align-items-center py-1">
                                        <div class="rounded-circle bg-primary bg-gradient text-white fw-bold d-flex justify-content-center align-items-center shadow-sm"
                                            style="width: 45px; height: 45px; font-size: 1.05rem;">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                        <div class="ms-3 lh-sm d-flex flex-column justify-content-center">
                                            <span class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">${row.title}</span>
                                            <span class="text-muted" style="font-size: 0.85rem;">${row.type}</span>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                        {
                            title: "Type",
                            field: "type",
                            minWidth: 140,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `<span class="fw-semibold text-dark">${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Pass Marks",
                            field: "passMarks",
                            minWidth: 110,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `<span class="fw-semibold text-dark">${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Max Attempts",
                            field: "maxAttempts",
                            minWidth: 120,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `<span class="text-secondary fw-medium">${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Questions No.",
                            field: "questionsNumber",
                            minWidth: 125,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `<span class="text-secondary fw-medium">${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Status",
                            field: "status",
                            minWidth: 120,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `<span class="badge bg-${row.statusColor} bg-opacity-10 text-${row.statusColor} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;">${row.status}</span>`;
                            }
                        },
                        {
                            title: "Actions",
                            headerHozAlign: "center",
                            hozAlign: "center",
                            width: 150,
                            headerSort: false,
                            formatter(cell) {
                                const row = cell.getRow().getData();

                                return `
                                    <div class="d-flex justify-content-center align-items-center gap-2 h-100">
                                        <button class="action-btn btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="View">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <a href="/exams/edit/${row.id}" class="action-btn btn btn-sm btn-light text-warning shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; text-decoration: none;" title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <button class="action-btn btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                `;
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-admin-layout>
