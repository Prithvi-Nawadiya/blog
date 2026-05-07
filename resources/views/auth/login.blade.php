@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center fade-in-up" style="min-height: 70vh;">
    <div class="col-md-7 col-lg-5 col-xl-4">
        <div class="glass-panel p-4 p-md-5 text-center shadow-sm" style="border-radius: 16px;">
            <div class="mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm mb-3" style="width:70px; height:70px; background: rgba(139, 92, 246, 0.1);">
                    <i class="fa-solid fa-seedling fs-3 text-white"></i>
                </div>
                <h2 class="fw-bold mb-1 text-white" style="letter-spacing: -0.5px; font-size: 2rem;">Welcome Back</h2>
                <p class="text-muted" style="font-size: 0.95rem;">Enter your details to access your space.</p>
            </div>

            <form action="{{ route('login.submit') }}" method="POST" class="text-start">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-medium text-muted ms-1 small text-uppercase tracking-wider" style="font-size: 0.75rem;">Email Address</label>
                    <input type="email" name="email" class="form-control shadow-sm" required value="{{ old('email') }}" placeholder="hello@aurablog.com">
                    @error('email') <div class="text-danger small mt-1 ms-1 fw-medium">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-medium text-muted ms-1 small text-uppercase tracking-wider" style="font-size: 0.75rem;">Password</label>
                    <input type="password" name="password" class="form-control shadow-sm" required placeholder="••••••••">
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4 ms-1">
                    <div class="form-check">
                        <input class="form-check-input border-secondary bg-transparent shadow-none" type="checkbox" name="remember" id="remember" style="width: 1rem; height: 1rem; margin-top: 0.2rem;">
                        <label class="form-check-label text-muted ms-1" for="remember" style="font-size: 0.9rem;">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted hover-text-white" style="font-size: 0.9rem;">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-premium w-100 py-2 mb-4 fw-medium">Sign In <i class="fa-solid fa-arrow-right ms-2"></i></button>
                
                <div class="text-center pt-3 border-top border-dark">
                    <span class="text-muted" style="font-size: 0.9rem;">New to AuraBlog?</span> 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-medium ms-1 text-white" style="font-size: 0.9rem;">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
