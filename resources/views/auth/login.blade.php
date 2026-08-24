<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 35%, #f8fafc 100%);
            font-family: "Segoe UI", sans-serif;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-box {
            width: min(100%, 430px);
        }

        .login-card {
            border: 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            border-bottom: 0;
            padding: 1.5rem 1rem;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 0.85rem;
            color: #fff !important;
            font-size: 1.6rem;
            font-weight: 700;
            text-decoration: none;
        }

        .brand-link img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            filter: drop-shadow(0 6px 10px rgba(15, 23, 42, 0.15));
        }

        .card-body {
            padding: 2rem 1.6rem 1.4rem;
        }

        .login-box-msg {
            margin-bottom: 1.5rem;
            color: #475569;
            font-weight: 600;
            letter-spacing: 0.01em;
        }

        .custom-input-group {
            position: relative;
        }

        .custom-input-group .bi {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.05rem;
            z-index: 2;
        }

        .custom-input-group .form-control {
            height: 52px;
            border-radius: 12px;
            border: 1px solid #dbe4f0;
            background: #f8fafc;
            padding-left: 2.8rem;
            color: #0f172a;
            box-shadow: none;
        }

        .custom-input-group .form-control:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 0.2rem rgba(96, 165, 250, 0.18);
            background: #fff;
        }

        .login-options {
            margin: 1rem 0 1.5rem;
        }

        .form-check-label,
        .text-link {
            font-size: 0.92rem;
            color: #475569;
        }

        .btn-login {
            height: 52px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.02em;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: 0;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }

        .card-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.9rem;
        }

        @media (max-width: 575.98px) {
            .card-body {
                padding-left: 1.1rem;
                padding-right: 1.1rem;
            }

            .brand-link {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card login-card card-outline card-primary shadow-lg border-0">

            <div class="card-body">
                <p class="login-box-msg h5 mb-4">Sign in to manage your platform</p>

                <form action="{{ route('admin.login.store') }}" method="POST">
                    @csrf

                    <div class="mb-3 custom-input-group">
                        <i class="bi bi-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email address" required
                            autocomplete="email" />
                    </div>


                    <div class="mb-3 custom-input-group">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required
                            autocomplete="current-password" />
                    </div>
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">
                    <label for="remember" class="form-check-label">Remember Me</label>
                    @error('email')
                        <div class="text-danger mb-2 fs-6 text-center">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-login w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
