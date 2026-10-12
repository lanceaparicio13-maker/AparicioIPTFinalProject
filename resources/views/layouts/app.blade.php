<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Music School Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            color: #253047;
        }

        .sidebar {
            min-height: 100vh;
            background: #172554;
        }

        .brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            border-radius: .5rem;
            padding: .7rem 1rem;
            margin-bottom: .25rem;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #334155;
            color: #fff;
        }

        .main-content {
            min-width: 0;
        }

        .topbar, .content-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: .85rem;
        }

        .stat-card {
            border: 0;
            border-radius: .85rem;
            box-shadow: 0 3px 14px rgba(15, 23, 42, .05);
        }

        .table th {
            white-space: nowrap;
            color: #475569;
            font-size: .875rem;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <aside class="col-md-3 col-lg-2 sidebar p-3">
            <a href="{{ route('dashboard') }}"
               class="brand text-decoration-none d-block mb-4">
                <span class="me-2">♫</span> Aparicio Music School
            </a>

            <div class="text-uppercase small text-secondary mb-2">
                Main menu
            </div>

            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('students.index') }}"
                   class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    Students
                </a>

                <a href="{{ route('instructors.index') }}"
                   class="nav-link {{ request()->routeIs('instructors.*') ? 'active' : '' }}">
                    Instructors
                </a>

                <a href="{{ route('instruments.index') }}"
                   class="nav-link {{ request()->routeIs('instruments.*') ? 'active' : '' }}">
                    Instruments
                </a>

                <a href="{{ route('courses.index') }}"
                   class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    Courses
                </a>

                <a href="{{ route('enrollments.index') }}"
                   class="nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                    Enrollments
                </a>
            </nav>

            <div class="small text-secondary mt-5">
                Music School Management System
            </div>
        </aside>

        <main class="col-md-9 col-lg-10 main-content p-3 p-lg-4">
            <header class="topbar d-flex justify-content-between
                           align-items-center p-3 mb-4">
                <div>
                    <h5 class="mb-1">@yield('page-heading', 'Dashboard')</h5>
                    <small class="text-secondary">
                        Manage your music school in one place.
                    </small>
                </div>

                <span class="badge text-bg-primary">Admin</span>
            </header>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show"
                     role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Please correct the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

            <footer class="text-center text-secondary small py-4">
                &copy; {{ date('Y') }} Melody Music School
            </footer>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
