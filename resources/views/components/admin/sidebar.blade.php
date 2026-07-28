<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="brand-link">
            <img
                src="{{ asset('adminlte/dist/assets/img/logo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
{{--            <span class="brand-text fw-light"> Academy Admin</span>--}}
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="navigation" aria-label="Main navigation">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/students') }}" class="nav-link {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/courses') }}" class="nav-link {{ request()->is('admin/courses*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-bookmark"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/exams') }}" class="nav-link {{ request()->is('admin/exams*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>Exams</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/enrollments') }}" class="nav-link {{ request()->is('admin/enrollments*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-check"></i>
                        <p>Enrollments</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/faqs') }}" class="nav-link {{ request()->is('admin/faqs*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-question-circle"></i>
                        <p>FAQs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/success-stories') }}" class="nav-link {{ request()->is('admin/success-stories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-trophy"></i>
                        <p>Success Stories</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/gallery') }}" class="nav-link {{ request()->is('admin/gallery*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/push-notifications') }}" class="nav-link {{ request()->is('admin/push-notifications*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bell"></i>
                        <p>Push Notifications</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/settings') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
