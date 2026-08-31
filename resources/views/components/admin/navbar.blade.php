<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <!-- Language -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="languageDropdown"
                    aria-label="Change language"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-translate"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">

                    <li>
                        <a href="{{ route('lang.index', 'en') }}"
                            class="dropdown-item d-flex align-items-center">
                            <span class="me-2">🇬🇧</span>
                            English

                            @if(app()->getLocale() === 'en')
                                <i class="bi bi-check-lg ms-auto"></i>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('lang.index', 'ar') }}"
                            class="dropdown-item d-flex align-items-center">
                            <span class="me-2">🇪🇬</span>
                            العربية

                            @if(app()->getLocale() === 'ar')
                                <i class="bi bi-check-lg ms-auto"></i>
                            @endif
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                    <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                    <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme">
                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="light">
                            <i class="bi bi-sun-fill me-2"></i>
                            Light
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>

                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="dark">
                            <i class="bi bi-moon-fill me-2"></i>
                            Dark
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>

                    <li>
                        <button type="button" class="dropdown-item d-flex align-items-center"
                            data-bs-theme-value="auto">
                            <i class="bi bi-circle-half me-2"></i>
                            Auto
                            <i class="bi bi-check-lg ms-auto d-none"></i>
                        </button>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                    data-bs-toggle="dropdown">
                    <span
                        class="user-image rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill"></i>
                    </span>

                    <span class="d-none d-md-inline">
                        {{ auth('admin')->user()->first_name }}
                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="px-3 py-2">
                        <div class="fw-semibold">
                            {{ auth('admin')->user()->first_name }}
                        </div>

                        <small class="text-body-secondary">
                            {{ auth('admin')->user()->email }}
                        </small>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="dropdown-item d-flex align-items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>