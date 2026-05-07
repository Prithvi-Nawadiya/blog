@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center fade-in-up my-5">
    <div class="col-md-6 col-lg-5">
        <div class="glass-panel p-5 text-center shadow-sm">
            <h3 class="fw-bold mb-3">Forgot Password</h3>
            <p class="text-muted mb-4 fs-6">Enter your email address and we will send you a password reset link.</p>
            
            @if (session('success'))
                <div class="alert alert-success mb-4 bg-transparent border-success" style="color: #4ade80;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="text-start">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold text-muted ms-1 small text-uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-white bg-opacity-75 shadow-sm" required value="{{ old('email') }}" placeholder="hello@aurablog.com">
                    @error('email') <div class="text-danger small mt-2 ms-1 fw-medium">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-premium w-100 py-3 mb-3">Send Reset Link</button>
            </form>
            
            <div class="text-center pt-3 border-top border-light border-2 mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none fw-medium text-muted hover-text-primary"><i class="fa-solid fa-arrow-left me-2"></i> Back to login</a>
            </div>
        </div>
    </div>
</div>
@endsection
