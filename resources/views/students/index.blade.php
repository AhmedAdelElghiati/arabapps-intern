<x-admin-layout>
    @include('components.admin.partials.tabulator')
    <div class="card container-fluid  border-0 shadow-sm rounded-4 mt-4 ">

        <div class="card-header bg-white border-bottom py-3">
            <div class="row align-items-center gy-3">
                <div class="col-md-5">
                    <h4 class="card-title mb-0 d-flex align-items-center fw-bold">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                            <i class="bi bi-mortarboard-fill fs-5"></i>
                        </div>
                        Students
                    </h4>
                </div>

                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-3">
                    <div class="input-group" style="max-width: 320px;">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Search students...">
                    </div>

                    <a href="students/create" class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        Add Student
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0"> <!-- p-0 removes padding so table fits edge-to-edge -->
            <div id="studentsTable" class="border-0"></div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const students = [
                    {
                        id: 1001,
                        avatar: "A", avatarColor: "primary",
                        name: "Ahmed Adel", school: "STEM School",
                        email: "ahmed@gmail.com", phone: "01012345678",
                        grade: "Grade 12", gradeColor: "info",
                        type: "Online", typeColor: "primary",
                        status: "Active", statusColor: "success",
                        joined: "28 Jul 2026"
                    },
                    {
                        id: 1002,
                        avatar: "M", avatarColor: "success",
                        name: "Mohamed Ali", school: "Future Language School",
                        email: "mohamed.a@gmail.com", phone: "01198765432",
                        grade: "Grade 10", gradeColor: "secondary",
                        type: "Offline", typeColor: "success",
                        status: "Inactive", statusColor: "danger",
                        joined: "15 Jan 2026"
                    },
                    {
                        id: 1003,
                        avatar: "S", avatarColor: "warning",
                        name: "Sara Youssef", school: "International Academy",
                        email: "sara.y@hotmail.com", phone: "01234567890",
                        grade: "Grade 11", gradeColor: "warning",
                        type: "Hybrid", typeColor: "info",
                        status: "Active", statusColor: "success",
                        joined: "05 Mar 2026"
                    },
                    {
                        id: 1004,
                        avatar: "O", avatarColor: "danger",
                        name: "Omar Hassan", school: "Modern Pioneers",
                        email: "omar.h@yahoo.com", phone: "01555443322",
                        grade: "Grade 12", gradeColor: "info",
                        type: "Online", typeColor: "primary",
                        status: "Pending", statusColor: "warning",
                        joined: "20 Jul 2026"
                    },
                    {
                        id: 1005,
                        avatar: "L", avatarColor: "info",
                        name: "Laila Mahmoud", school: "British International",
                        email: "laila.m@gmail.com", phone: "01099887766",
                        grade: "Grade 10", gradeColor: "secondary",
                        type: "Offline", typeColor: "success",
                        status: "Active", statusColor: "success",
                        joined: "12 Dec 2025"
                    },
                    {
                        id: 1006,
                        avatar: "Y", avatarColor: "primary",
                        name: "Youssef Ibrahim", school: "STEM School",
                        email: "y.ibrahim@gmail.com", phone: "01122334455",
                        grade: "Grade 11", gradeColor: "warning",
                        type: "Online", typeColor: "primary",
                        status: "Active", statusColor: "success",
                        joined: "01 Feb 2026"
                    },
                    {
                        id: 1007,
                        avatar: "N", avatarColor: "secondary",
                        name: "Nour Tarek", school: "Future Language School",
                        email: "nour.t@gmail.com", phone: "01288776655",
                        grade: "Grade 12", gradeColor: "info",
                        type: "Hybrid", typeColor: "info",
                        status: "Inactive", statusColor: "danger",
                        joined: "18 Nov 2025"
                    },
                    {
                        id: 1008,
                        avatar: "H", avatarColor: "success",
                        name: "Hala Saad", school: "Smart Vision School",
                        email: "hala.saad@hotmail.com", phone: "01044556677",
                        grade: "Grade 10", gradeColor: "secondary",
                        type: "Offline", typeColor: "success",
                        status: "Active", statusColor: "success",
                        joined: "30 Apr 2026"
                    },
                    {
                        id: 1009,
                        avatar: "K", avatarColor: "warning",
                        name: "Karim Wael", school: "International Academy",
                        email: "k.wael@gmail.com", phone: "01511223344",
                        grade: "Grade 11", gradeColor: "warning",
                        type: "Online", typeColor: "primary",
                        status: "Pending", statusColor: "warning",
                        joined: "25 Jul 2026"
                    },
                    {
                        id: 1010,
                        avatar: "M", avatarColor: "danger",
                        name: "Mona Kamal", school: "Modern Pioneers",
                        email: "mona.k@yahoo.com", phone: "01155667788",
                        grade: "Grade 12", gradeColor: "info",
                        type: "Hybrid", typeColor: "info",
                        status: "Active", statusColor: "success",
                        joined: "08 Oct 2025"
                    },
                    {
                        id: 1011,
                        avatar: "Z", avatarColor: "info",
                        name: "Ziad Mostafa", school: "STEM School",
                        email: "ziad.m@gmail.com", phone: "01299887766",
                        grade: "Grade 10", gradeColor: "secondary",
                        type: "Offline", typeColor: "success",
                        status: "Inactive", statusColor: "danger",
                        joined: "14 May 2026"
                    },
                    {
                        id: 1012,
                        avatar: "D", avatarColor: "primary",
                        name: "Dina Farouk", school: "British International",
                        email: "dina.f@gmail.com", phone: "01033445566",
                        grade: "Grade 11", gradeColor: "warning",
                        type: "Online", typeColor: "primary",
                        status: "Active", statusColor: "success",
                        joined: "22 Jun 2026"
                    }
                ];

                new Tabulator("#studentsTable", {
                    data: students,
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
                            title: "Student",
                            field: "name",
                            minWidth: 250,
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `
                            <div class="d-flex align-items-center py-1">
                                <div class="rounded-circle bg-${row.avatarColor} bg-gradient text-white fw-bold d-flex justify-content-center align-items-center shadow-sm"
                                    style="width: 45px; height: 45px; font-size: 1.1rem;">
                                    ${row.avatar}
                                </div>
                                <div class="ms-3 lh-sm d-flex flex-column justify-content-center">
                                    <span class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">${row.name}</span>
                                    <span class="text-muted" style="font-size: 0.85rem;">${row.school}</span>
                                </div>
                            </div>
                        `;
                            }
                        },
                        {
                            title: "Contact Info",
                            field: "email",
                            minWidth: 200,
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `
                            <div class="d-flex flex-column justify-content-center h-100 lh-sm">
                                <span class="text-dark mb-1" style="font-size: 0.9rem;">
                                    <i class="bi bi-envelope text-muted me-2"></i>${row.email}
                                </span>
                                <span class="text-muted" style="font-size: 0.85rem;">
                                    <i class="bi bi-telephone me-2"></i>${row.phone}
                                </span>
                            </div>
                        `;
                            }
                        },
                        {
                            title: "Grade",
                            field: "grade",
                            minWidth: 110,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `<span class="badge bg-${row.gradeColor} bg-opacity-10 text-${row.gradeColor} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;">${row.grade}</span>`;
                            }
                        },
                        {
                            title: "Type",
                            field: "type",
                            minWidth: 110,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `<span class="badge bg-${row.typeColor} bg-opacity-10 text-${row.typeColor} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;">${row.type}</span>`;
                            }
                        },
                        {
                            title: "Status",
                            field: "status",
                            minWidth: 110,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `<span class="badge bg-${row.statusColor} bg-opacity-10 text-${row.statusColor} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;">${row.status}</span>`;
                            }
                        },
                        {
                            title: "Joined",
                            field: "joined",
                            minWidth: 130,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            sorter: function(a, b, aRow, bRow, column, dir, sorterParams) {
                                return new Date(a) - new Date(b);
                            },
                            formatter(cell) {
                                return `<span class="text-secondary fw-medium" style="font-size: 0.9rem;">${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Actions",
                            headerHozAlign: "center",
                            hozAlign: "center",
                            width: 150,
                            headerSort: false,
                            formatter(cell) {
                                // بنسحب بيانات السطر الحالي عشان نجيب الـ ID
                                const row = cell.getRow().getData();

                                return `
        <div class="d-flex justify-content-center align-items-center gap-2 h-100">
            <button class="action-btn btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="View">
                <i class="bi bi-eye-fill"></i>
            </button>

            <!-- تم تغيير هذا الجزء إلى رابط <a> ليقوم بالتوجيه إلى صفحة التعديل -->
            <a href="/students/edit/${row.id}" class="action-btn btn btn-sm btn-light text-warning shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; text-decoration: none;" title="Edit">
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
