<x-admin-layout>
    @include('components.admin.partials.tabulator')
    <div class="card container-fluid border-0 shadow-sm rounded-4 mt-4">

        <div class="card-header bg-white border-bottom py-3">
            <div class="row align-items-center gy-3">
                <div class="col-md-5">
                    <h4 class="card-title mb-0 d-flex align-items-center fw-bold">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3 me-3 d-flex">
                            <i class="bi bi-book-fill fs-5"></i>
                        </div>
                        Courses
                    </h4>
                </div>

                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-3">
                    <div class="input-group" style="max-width: 320px;">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control bg-light border-start-0 ps-0" placeholder="Search courses...">
                    </div>

                    <a href="courses/create" class="btn btn-primary d-flex align-items-center gap-2 px-3 fw-medium shadow-sm">
                        <i class="bi bi-plus-lg"></i>
                        Add Course
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div id="coursesTable" class="border-0"></div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Dummy data based on the provided schema
                const courses = [
                    {
                        id: 1,
                        title: "Advanced Mathematics",
                        image_url: "https://ui-avatars.com/api/?name=Math&background=random&color=fff&size=100",
                        description: "Deep dive into calculus and algebra.",
                        is_free: false,
                        price: 150.00,
                        discount: 20.00,
                        level: "Advanced",
                        access_days: 30,
                        display_order: 1,
                        lessons_count: 5,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "28 Jul 2026"
                    },
                    {
                        id: 2,
                        title: "Physics for Beginners",
                        image_url: "https://ui-avatars.com/api/?name=Physics&background=random&color=fff&size=100",
                        description: "Basic mechanics and thermodynamics.",
                        is_free: true,
                        price: 0,
                        discount: 0,
                        level: "Beginner",
                        access_days: 60,
                        display_order: 2,
                        lessons_count: 10,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "15 Jan 2026"
                    },
                    {
                        id: 3,
                        title: "Chemistry 101",
                        image_url: "https://ui-avatars.com/api/?name=Chemistry&background=random&color=fff&size=100",
                        description: "Introduction to organic chemistry.",
                        is_free: false,
                        price: 90.00,
                        discount: 0,
                        level: "Intermediate",
                        access_days: 90,
                        display_order: 3,
                        lessons_count: 8,
                        show_at_home: false,
                        is_published: false,
                        publish_date: null
                    },
                    {
                        id: 4,
                        title: "Web Development Bootcamp",
                        image_url: "https://ui-avatars.com/api/?name=Web&background=random&color=fff&size=100",
                        description: "Learn HTML, CSS, and JavaScript from scratch.",
                        is_free: false,
                        price: 199.99,
                        discount: 40,
                        level: "Beginner",
                        access_days: 120,
                        display_order: 4,
                        lessons_count: 32,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "10 Feb 2026"
                    },
                    {
                        id: 5,
                        title: "Laravel Masterclass",
                        image_url: "https://ui-avatars.com/api/?name=Laravel&background=random&color=fff&size=100",
                        description: "Build modern web applications with Laravel.",
                        is_free: false,
                        price: 180,
                        discount: 30,
                        level: "Advanced",
                        access_days: 180,
                        display_order: 5,
                        lessons_count: 25,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "05 Mar 2026"
                    },
                    {
                        id: 6,
                        title: "JavaScript Essentials",
                        image_url: "https://ui-avatars.com/api/?name=JS&background=random&color=fff&size=100",
                        description: "Understand JavaScript fundamentals.",
                        is_free: true,
                        price: 0,
                        discount: 0,
                        level: "Beginner",
                        access_days: 90,
                        display_order: 6,
                        lessons_count: 18,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "18 Apr 2026"
                    },
                    {
                        id: 7,
                        title: "Python Programming",
                        image_url: "https://ui-avatars.com/api/?name=Python&background=random&color=fff&size=100",
                        description: "Learn Python for automation and web development.",
                        is_free: false,
                        price: 140,
                        discount: 15,
                        level: "Intermediate",
                        access_days: 120,
                        display_order: 7,
                        lessons_count: 22,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "12 May 2026"
                    },
                    {
                        id: 8,
                        title: "Data Structures & Algorithms",
                        image_url: "https://ui-avatars.com/api/?name=DSA&background=random&color=fff&size=100",
                        description: "Master problem solving and coding interviews.",
                        is_free: false,
                        price: 220,
                        discount: 50,
                        level: "Advanced",
                        access_days: 365,
                        display_order: 8,
                        lessons_count: 40,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "01 Jun 2026"
                    },
                    {
                        id: 9,
                        title: "UI/UX Design Basics",
                        image_url: "https://ui-avatars.com/api/?name=UIUX&background=random&color=fff&size=100",
                        description: "Create beautiful and user-friendly interfaces.",
                        is_free: false,
                        price: 110,
                        discount: 10,
                        level: "Beginner",
                        access_days: 90,
                        display_order: 9,
                        lessons_count: 15,
                        show_at_home: false,
                        is_published: true,
                        publish_date: "15 Jun 2026"
                    },
                    {
                        id: 10,
                        title: "React Fundamentals",
                        image_url: "https://ui-avatars.com/api/?name=React&background=random&color=fff&size=100",
                        description: "Build interactive user interfaces using React.",
                        is_free: false,
                        price: 170,
                        discount: 25,
                        level: "Intermediate",
                        access_days: 120,
                        display_order: 10,
                        lessons_count: 28,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "30 Jun 2026"
                    },
                    {
                        id: 11,
                        title: "Node.js API Development",
                        image_url: "https://ui-avatars.com/api/?name=Node&background=random&color=fff&size=100",
                        description: "Develop REST APIs with Express.js.",
                        is_free: false,
                        price: 160,
                        discount: 20,
                        level: "Intermediate",
                        access_days: 120,
                        display_order: 11,
                        lessons_count: 20,
                        show_at_home: true,
                        is_published: false,
                        publish_date: null
                    },
                    {
                        id: 12,
                        title: "SQL Database Design",
                        image_url: "https://ui-avatars.com/api/?name=SQL&background=random&color=fff&size=100",
                        description: "Design efficient relational databases.",
                        is_free: true,
                        price: 0,
                        discount: 0,
                        level: "Beginner",
                        access_days: 60,
                        display_order: 12,
                        lessons_count: 12,
                        show_at_home: false,
                        is_published: true,
                        publish_date: "07 Jul 2026"
                    },
                    {
                        id: 13,
                        title: "Cybersecurity Fundamentals",
                        image_url: "https://ui-avatars.com/api/?name=Cyber&background=random&color=fff&size=100",
                        description: "Learn the basics of information security.",
                        is_free: false,
                        price: 145,
                        discount: 15,
                        level: "Intermediate",
                        access_days: 90,
                        display_order: 13,
                        lessons_count: 16,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "12 Jul 2026"
                    },
                    {
                        id: 14,
                        title: "Machine Learning Basics",
                        image_url: "https://ui-avatars.com/api/?name=ML&background=random&color=fff&size=100",
                        description: "Introduction to machine learning concepts.",
                        is_free: false,
                        price: 250,
                        discount: 50,
                        level: "Advanced",
                        access_days: 180,
                        display_order: 14,
                        lessons_count: 26,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "18 Jul 2026"
                    },
                    {
                        id: 15,
                        title: "Docker & Kubernetes",
                        image_url: "https://ui-avatars.com/api/?name=Docker&background=random&color=fff&size=100",
                        description: "Deploy and manage containerized applications.",
                        is_free: false,
                        price: 210,
                        discount: 35,
                        level: "Advanced",
                        access_days: 180,
                        display_order: 15,
                        lessons_count: 24,
                        show_at_home: false,
                        is_published: false,
                        publish_date: null
                    },
                    {
                        id: 16,
                        title: "Git & GitHub Complete Guide",
                        image_url: "https://ui-avatars.com/api/?name=Git&background=random&color=fff&size=100",
                        description: "Version control and collaboration made easy.",
                        is_free: true,
                        price: 0,
                        discount: 0,
                        level: "Beginner",
                        access_days: 45,
                        display_order: 16,
                        lessons_count: 14,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "22 Jul 2026"
                    },
                    {
                        id: 17,
                        title: "Flutter Mobile Development",
                        image_url: "https://ui-avatars.com/api/?name=Flutter&background=random&color=fff&size=100",
                        description: "Build cross-platform mobile applications.",
                        is_free: false,
                        price: 190,
                        discount: 20,
                        level: "Intermediate",
                        access_days: 150,
                        display_order: 17,
                        lessons_count: 30,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "25 Jul 2026"
                    },
                    {
                        id: 18,
                        title: "Cloud Computing with AWS",
                        image_url: "https://ui-avatars.com/api/?name=AWS&background=random&color=fff&size=100",
                        description: "Learn cloud infrastructure and AWS services.",
                        is_free: false,
                        price: 280,
                        discount: 60,
                        level: "Advanced",
                        access_days: 365,
                        display_order: 18,
                        lessons_count: 35,
                        show_at_home: true,
                        is_published: true,
                        publish_date: "29 Jul 2026"
                    }
                ];

                new Tabulator("#coursesTable", {
                    data: courses,
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
                            title: "Course",
                            field: "title",
                            minWidth: 280,
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                return `
                                <div class="d-flex align-items-center py-1">
                                    <div class="rounded-3 overflow-hidden shadow-sm flex-shrink-0" style="width: 50px; height: 50px;">
                                        <img src="${row.image_url}" alt="${row.title}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://placehold.co/50'">
                                    </div>
                                    <div class="ms-3 lh-sm d-flex flex-column justify-content-center text-truncate">
                                        <span class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.95rem;">${row.title}</span>
                                        <span class="text-muted text-truncate" style="font-size: 0.80rem;">${row.description.substring(0, 40)}...</span>
                                    </div>
                                </div>
                                `;
                            }
                        },
                        {
                            title: "Level",
                            field: "level",
                            minWidth: 120,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const level = cell.getValue();
                                let color = "info";
                                if(level.toLowerCase() === 'beginner') color = 'success';
                                if(level.toLowerCase() === 'advanced') color = 'danger';

                                return `<span class="badge bg-${color} bg-opacity-10 text-${color} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;">${level}</span>`;
                            }
                        },
                        {
                            title: "Pricing",
                            field: "price",
                            minWidth: 120,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const row = cell.getRow().getData();
                                if (row.is_free) {
                                    return `<span class="badge bg-success text-white px-3 py-2 rounded-pill fw-bold"><i class="bi bi-tag-fill me-1"></i> Free</span>`;
                                }

                                let html = `<div class="d-flex flex-column align-items-center lh-1">`;
                                html += `<span class="fw-bold text-dark">$${parseFloat(row.price).toFixed(2)}</span>`;
                                if (row.discount > 0) {
                                    html += `<small class="text-danger mt-1" style="font-size: 0.75rem;">-$${parseFloat(row.discount).toFixed(2)}</small>`;
                                }
                                html += `</div>`;
                                return html;
                            }
                        },
                        {
                            title: "Access Days",
                            field: "access_days",
                            minWidth: 100,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Lessons Count",
                            field: "lessons_count",
                            minWidth: 100,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Display Order",
                            field: "display_order",
                            minWidth: 100,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                return `${cell.getValue()}</span>`;
                            }
                        },
                        {
                            title: "Status",
                            field: "is_published",
                            minWidth: 110,
                            headerHozAlign: "center",
                            hozAlign: "center",
                            formatter(cell) {
                                const isPublished = cell.getValue();
                                const color = isPublished ? "success" : "secondary";
                                const text = isPublished ? "Published" : "Draft";
                                return `<span class="badge bg-${color} bg-opacity-10 text-${color} px-3 py-2 rounded-pill fw-semibold" style="letter-spacing: 0.3px;"><i class="bi ${isPublished ? 'bi-check-circle' : 'bi-clock'} me-1"></i> ${text}</span>`;
                            }
                        },
                        {
                            title: "Actions",
                            headerHozAlign: "center",
                            hozAlign: "center",
                            width: 100,
                            headerSort: false,
                            formatter(cell) {
                                return `
        <div class="d-flex justify-content-center align-items-center h-100">
            <button class="btn btn-sm btn-light text-muted shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
        </div>
        `;
                            },
                            clickMenu: function(e, cell) {
                                const row = cell.getRow().getData();
                                return [
                                    {
                                        label: `
                <div class="d-flex justify-content-between align-items-center w-100 px-2 py-1" style="min-width: 160px;">
                    <span class="fw-medium text-dark">View Course</span>
                    <i class="bi bi-eye text-dark ms-3"></i>
                </div>`,
                                        action: function(e, cell) {
                                            window.location.href = `/courses/${row.id}`;
                                        }
                                    },
                                    {
                                        label: `
                <div class="d-flex justify-content-between align-items-center w-100 px-2 py-1">
                    <span class="fw-medium text-dark">View Course Lessons</span>
                    <i class="bi bi-list-task text-dark ms-3"></i>
                </div>`,
                                        action: function(e, cell) {
                                            window.location.href = `/courses/${row.id}/lessons`;
                                        }
                                    },
                                    {
                                        label: `
                <div class="d-flex justify-content-between align-items-center w-100 px-2 py-1">
                    <span class="fw-medium text-dark">Edit Course</span>
                    <i class="bi bi-pencil text-dark ms-3"></i>
                </div>`,
                                        action: function(e, cell) {
                                            window.location.href = `/courses/edit/${row.id}`;
                                        }
                                    },
                                    {
                                        separator: true
                                    },
                                    {
                                        label: `
                <div class="d-flex justify-content-between align-items-center w-100 px-2 py-1 text-danger">
                    <span class="fw-medium">Archive Course</span>
                    <i class="bi bi-archive text-danger ms-3"></i>
                </div>`,
                                        action: function(e, cell) {
                                            if(confirm("Are you sure you want to archive this course?")) {
                                                console.log("Archiving course ID:", row.id);
                                            }
                                        }
                                    }
                                ];
                            }
                        }
                    ]
                });
            });
        </script>
    @endpush
</x-admin-layout>
