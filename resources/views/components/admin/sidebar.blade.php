<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ url('/') }}" class="brand-link">
            <img
                src="{{ asset('adminlte/dist/assets/img/logo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            {{-- <span class="brand-text fw-light"> Academy Admin</span> --}}
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" role="navigation" aria-label="Main navigation">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Students -->
                <li class="nav-item">
                    <a href="{{ url('/students') }}" class="nav-link {{ request()->is('students*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Students</p>
                    </a>
                </li>

                <!-- Courses -->
                <li class="nav-item">
                    <a href="{{ url('/courses') }}" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-journal-bookmark"></i>
                        <p>Courses</p>
                    </a>
                </li>

                <!-- Exams -->
                <li class="nav-item">
                    <a href="{{ url('/exams') }}" class="nav-link {{ request()->is('exams*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>Exams</p>
                    </a>
                </li>

                <!-- Enrollments -->
                <li class="nav-item">
                    <a href="{{ url('/enrollments') }}" class="nav-link {{ request()->is('enrollments*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-check"></i>
                        <p>Enrollments</p>
                    </a>
                </li>

                <!-- FAQs -->
                <li class="nav-item">
                    <a href="{{ url('/faqs') }}" class="nav-link {{ request()->is('faqs*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-question-circle"></i>
                        <p>FAQs</p>
                    </a>
                </li>

                <!-- Success Stories -->
                <li class="nav-item">
                    <a href="{{ url('/success-stories') }}" class="nav-link {{ request()->is('success-stories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-trophy"></i>
                        <p>Success Stories</p>
                    </a>
                </li>

                <!-- Gallery -->
                <li class="nav-item">
                    <a href="{{ url('/gallery') }}" class="nav-link {{ request()->is('gallery*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>

                <!-- Push Notifications -->
                <li class="nav-item">
                    <a href="{{ url('/push-notifications') }}" class="nav-link {{ request()->is('push-notifications*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-bell"></i>
                        <p>Push Notifications</p>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="{{ url('/settings') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
