<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireOn - Premium Lifestyle Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/premium.css">
    @stack('styles')
</head>
<body>
    <div class="glow-bg"></div>

    <nav class="navbar navbar-expand-lg navbar-dark glass-nav sticky-top py-2">
        <div class="container-fluid px-4 px-lg-5" style="max-width: 1200px;">
            <a class="navbar-brand fw-bold fs-5 d-flex align-items-center" href="{{ route('frontend.index') }}">
                <i class="fa-solid fa-layer-group me-2" style="color: var(--accent-muted);"></i>
                <span class="text-heading">HireOn</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="width: 1.2rem; height: 1.2rem;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link fw-medium fs-6 text-main opacity-75 hover-opacity-100" href="{{ route('frontend.index') }}">Explore</a>
                    </li>
                    @auth
                        <li class="nav-item me-3"><a class="nav-link fw-medium fs-6 text-main opacity-75 hover-opacity-100" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @endauth
                    <li class="nav-item me-3">
                        <a class="nav-link fw-medium fs-6 text-main opacity-75 hover-opacity-100 {{ request()->routeIs('frontend.about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">About</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-medium fs-6 d-flex align-items-center text-main" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=202024&color=e4e4e7&bold=true" class="rounded-circle me-2 border border-secondary border-opacity-25" width="28">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end glass-panel border border-secondary border-opacity-25 shadow-sm mt-2 p-2" style="font-size: 0.9rem;">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger rounded px-3 py-2 fw-medium bg-transparent hover-bg-dark"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Sign Out</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link fw-medium fs-6 text-main opacity-75 hover-opacity-100" href="{{ route('login') }}">Sign In</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container-fluid px-4 px-lg-5 py-4 min-vh-100 position-relative z-1" style="max-width: 1200px;">
        @if(session('success'))
            <div class="alert glass-panel border-success text-success alert-dismissible fade show fade-in-up shadow-sm mb-4 p-3 fs-6" role="alert" style="background: rgba(34, 197, 94, 0.05) !important;">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" style="padding: 1.1rem; filter: invert(1) grayscale(100%) brightness(200%);"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert glass-panel border-danger text-danger alert-dismissible fade show fade-in-up shadow-sm mb-4 p-3 fs-6" role="alert" style="background: rgba(239, 68, 68, 0.05) !important;">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" style="padding: 1.1rem; filter: invert(1) grayscale(100%) brightness(200%);"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Contact Section -->
    <div class="container-fluid px-4 px-lg-5 mt-5 pt-5 pb-2" style="max-width: 1200px;">
        <div class="glass-panel p-4 p-md-5 border-0 shadow-sm text-center fade-in-up" style="border-radius: 16px; background: linear-gradient(145deg, var(--bg-card) 0%, var(--bg-dark) 100%);">
            <h3 class="fw-bold mb-3 text-heading" style="letter-spacing: -0.5px;">Have feedback or ideas?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 500px; font-size: 0.95rem;">Feel free to reach out anytime for collaboration opportunities or support. We'd love to hear from you.</p>
            
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-4 mt-5">
                <a href="mailto:sec2end1234@gmail.com" class="text-decoration-none text-main hover-accent d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded-circle me-3" style="width: 44px; height: 44px; background: rgba(139, 92, 246, 0.1); color: var(--accent-muted);">
                        <i class="fa-regular fa-envelope fs-5"></i>
                    </div>
                    <span class="fw-medium fs-6">sec2end1234@gmail.com</span>
                </a>
                
                <div class="d-none d-md-block" style="width: 1px; height: 30px; background: var(--border-dark);"></div>
                
                <a href="tel:8769889001" class="text-decoration-none text-main hover-accent d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center rounded-circle me-3" style="width: 44px; height: 44px; background: rgba(139, 92, 246, 0.1); color: var(--accent-muted);">
                        <i class="fa-solid fa-phone fs-5"></i>
                    </div>
                    <span class="fw-medium fs-6">8769889001</span>
                </a>
            </div>
            
            <div class="d-flex justify-content-center gap-3 mt-5 pt-4 border-top" style="border-color: var(--border-dark) !important;">
                <a href="#" class="btn btn-light rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center text-muted hover-accent" style="width:36px; height:36px; background: rgba(255,255,255,0.02) !important;"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="btn btn-light rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center text-muted hover-accent" style="width:36px; height:36px; background: rgba(255,255,255,0.02) !important;"><i class="fa-brands fa-github"></i></a>
                <a href="#" class="btn btn-light rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center text-muted hover-accent" style="width:36px; height:36px; background: rgba(255,255,255,0.02) !important;"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <footer class="text-center py-5 mt-5 border-top glass-nav" style="border-color: var(--border-dark) !important;">
        <div class="container-fluid px-4 px-lg-5" style="max-width: 1200px;">
            <i class="fa-solid fa-layer-group fs-5 mb-3" style="color: var(--accent-muted); opacity: 0.8;"></i>
            <h5 class="fw-bold text-heading mb-2">HireOn</h5>
            <p class="mb-0 fw-medium text-muted" style="font-size: 0.85rem !important;">&copy; {{ date('Y') }} HireOn. The premium platform for creators.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    </script>
    @stack('scripts')
</body>
</html>
