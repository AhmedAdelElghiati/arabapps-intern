<x-admin-layout>
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="text-primary text-uppercase small fw-semibold mb-1">Overview</p>
                    <h1 class="mb-1">Good morning, {{ auth('admin')->user()->first_name }} </h1>
                    <p class="text-body-secondary mb-0">Here’s what’s happening with your learning platform today.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label for="stats-period" class="small text-body-secondary text-nowrap">Stats period</label>
                    <select id="stats-period" class="form-select form-select-sm" aria-label="Select statistics period">
                        <option value="today">Today</option>
                        <option value="this-week">This week</option>
                        <option value="this-month" selected>This month</option>
                        <option value="last-month">Last month</option>
                        <option value="this-year">This year</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-body-secondary mb-2">Total students</p>
                                    <h2 class="fw-bold mb-2">1,248</h2>
                                    <span class="badge text-bg-success-subtle text-success-emphasis"><i
                                            class="bi bi-arrow-up me-1"></i>12.8%</span>
                                    <span class="small text-body-secondary ms-1 comparison-period">vs last month</span>
                                </div>
                                <span class="rounded-3 bg-primary-subtle text-primary p-3"><i
                                        class="bi bi-people fs-4"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-body-secondary mb-2">Total courses</p>
                                    <h2 class="fw-bold mb-2">24</h2>
                                    <span class="badge text-bg-success-subtle text-success-emphasis"><i
                                            class="bi bi-arrow-up me-1"></i>8.4%</span>
                                    <span class="small text-body-secondary ms-1 comparison-period">vs last month</span>
                                </div>
                                <span class="rounded-3 bg-success-subtle text-success p-3"><i
                                        class="bi bi-journal-bookmark fs-4"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-body-secondary mb-2">Exams completed</p>
                                    <h2 class="fw-bold mb-2">86</h2>
                                    <span class="badge text-bg-success-subtle text-success-emphasis"><i
                                            class="bi bi-arrow-up me-1"></i>16.2%</span>
                                    <span class="small text-body-secondary ms-1 comparison-period">vs last month</span>
                                </div>
                                <span class="rounded-3 bg-warning-subtle text-warning-emphasis p-3"><i
                                        class="bi bi-file-earmark-check fs-4"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-body-secondary mb-2">Total enrollments</p>
                                    <h2 class="fw-bold mb-2">3,842</h2>
                                    <span class="badge text-bg-success-subtle text-success-emphasis"><i
                                            class="bi bi-arrow-up me-1"></i>10.1%</span>
                                    <span class="small text-body-secondary ms-1 comparison-period">vs last month</span>
                                </div>
                                <span class="rounded-3 bg-info-subtle text-info-emphasis p-3"><i
                                        class="bi bi-person-check fs-4"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-xl-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4 gap-3">
                            <div class="flex-grow-1 min-w-0">
                                <h5 class="mb-1">Revenue overview</h5>
                                <p class="text-body-secondary small mb-0">Monthly revenue performance over the last
                                    seven months</p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <label for="stats-period" class="small text-body-secondary text-nowrap">Stats
                                    period</label>
                                <select id="stats-period" class="form-select form-select-sm"
                                    aria-label="Select statistics period">
                                    <option value="today">Today</option>
                                    <option value="this-week">This week</option>
                                    <option value="this-month" selected>This month</option>
                                    <option value="last-month">Last month</option>
                                    <option value="this-year">This year</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body px-4">
                            <div id="revenue-chart" style="min-height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4 gap-3">
                            <div class="flex-grow-1 min-w-0">
                                <h5 class="mb-1">Enrollment overview</h5>
                                <p class="text-body-secondary small mb-0">New student enrollments over the last seven
                                    months</p>
                            </div>
                            <a href="{{ url('//enrollments') }}"
                                class="small text-decoration-none flex-shrink-0 text-nowrap">View all <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                        <div class="card-body px-4">
                            <div id="enrollment-chart" style="min-height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-xl-8">
                    <div class="card border-0 shadow-sm">
                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4 gap-3">
                            <h5 class="mb-0 flex-grow-1">Recent enrollments</h5>
                            <a href="{{ url('//enrollments') }}"
                                class="small text-decoration-none flex-shrink-0 text-nowrap">View all <i
                                    class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Student</th>
                                        <th>Course</th>
                                        <th>Date</th>
                                        <th class="pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4"><strong>Sarah Ahmed</strong><small
                                                class="d-block text-body-secondary">sarah@example.com</small></td>
                                        <td>UI/UX Design</td>
                                        <td>Today, 10:24 AM</td>
                                        <td class="pe-4"><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4"><strong>Omar Hassan</strong><small
                                                class="d-block text-body-secondary">omar@example.com</small></td>
                                        <td>Web Development</td>
                                        <td>Today, 09:15 AM</td>
                                        <td class="pe-4"><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4"><strong>Amira Khaled</strong><small
                                                class="d-block text-body-secondary">amira@example.com</small></td>
                                        <td>Digital Marketing</td>
                                        <td>Yesterday</td>
                                        <td class="pe-4"><span class="badge text-bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4"><strong>Youssef Ali</strong><small
                                                class="d-block text-body-secondary">youssef@example.com</small></td>
                                        <td>Data Analytics</td>
                                        <td>Yesterday</td>
                                        <td class="pe-4"><span class="badge text-bg-success">Active</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 px-4 gap-3">
                            <h5 class="mb-0 flex-grow-1">Top grades</h5>
                            <a href="{{ url('//exams') }}"
                                class="small text-decoration-none flex-shrink-0 text-nowrap">View all</a>
                        </div>
                        <div class="card-body px-4">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span
                                    class="rounded-circle bg-primary-subtle text-primary fw-bold d-inline-flex align-items-center justify-content-center"
                                    style="width: 42px; height: 42px;">10</span>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2"><span>Grade
                                            10</span><strong>88%</strong></div>
                                    <div class="progress" style="height: 7px">
                                        <div class="progress-bar" style="width: 88%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span
                                    class="rounded-circle bg-success-subtle text-success fw-bold d-inline-flex align-items-center justify-content-center"
                                    style="width: 42px; height: 42px;">11</span>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2"><span>Grade
                                            11</span><strong>81%</strong></div>
                                    <div class="progress" style="height: 7px">
                                        <div class="progress-bar bg-success" style="width: 81%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span
                                    class="rounded-circle bg-warning-subtle text-warning-emphasis fw-bold d-inline-flex align-items-center justify-content-center"
                                    style="width: 42px; height: 42px;">12</span>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2"><span>Grade
                                            12</span><strong>76%</strong></div>
                                    <div class="progress" style="height: 7px">
                                        <div class="progress-bar bg-warning" style="width: 76%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            (() => {
                const periodSelect = document.querySelector('#stats-period');
                const comparisonLabels = document.querySelectorAll('.comparison-period');
                const comparisons = {
                    today: 'vs yesterday',
                    'this-week': 'vs last week',
                    'this-month': 'vs last month',
                    'last-month': 'vs previous month',
                    'this-year': 'vs last year',
                };

                periodSelect?.addEventListener('change', (event) => {
                    const comparison = comparisons[event.target.value] ?? 'vs previous period';
                    comparisonLabels.forEach((label) => {
                        label.textContent = comparison;
                    });
                });
            })();
            const formatEGP = (value) => new Intl.NumberFormat('en-EG', {
                style: 'currency',
                currency: 'EGP',
                maximumFractionDigits: 0,
            }).format(value);

            const sales_chart_options = {
                series: [{
                    name: 'Revenue',
                    data: [18400, 22100, 19800, 26700, 29400, 32100, 35600],
                }, ],
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                legend: {
                    show: false,
                },
                colors: ['#0d6efd'],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: 'smooth',
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        '2026-01-01',
                        '2026-02-01',
                        '2026-03-01',
                        '2026-04-01',
                        '2026-05-01',
                        '2026-06-01',
                        '2026-07-01',
                    ],
                },
                tooltip: {
                    x: {
                        format: 'MMMM yyyy',
                    },
                    y: {
                        formatter: (value) => formatEGP(value),
                    },
                },
                yaxis: {
                    labels: {
                        formatter: (value) => formatEGP(value),
                    },
                },
            };

            const sales_chart = new ApexCharts(
                document.querySelector('#revenue-chart'),
                sales_chart_options,
            );
            sales_chart.render();

            const enrollment_chart = new ApexCharts(
                document.querySelector('#enrollment-chart'), {
                    series: [{
                        name: 'Enrollments',
                        data: [382, 446, 418, 530, 574, 641, 712]
                    }],
                    chart: {
                        height: 300,
                        type: 'bar',
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#20c997'],
                    plotOptions: {
                        bar: {
                            borderRadius: 5,
                            columnWidth: '45%'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
                    },
                    yaxis: {
                        labels: {
                            formatter: (value) => Math.round(value)
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: (value) => `${value} students`
                        }
                    },
                },
            );
            enrollment_chart.render();
        </script>
    @endpush
</x-admin-layout>
