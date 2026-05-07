@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center fade-in-up my-5">
    <div class="col-md-6 col-lg-5">
        <div class="glass-panel p-5 text-center shadow-sm">
            <h3 class="fw-bold mb-4">Reset Password</h3>
            
            <form method="POST" action="{{ route('password.update') }}" class="text-start">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted ms-1 small text-uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-white bg-opacity-75 shadow-sm" required value="{{ $email ?? old('email') }}" readonly>
                    @error('email') <div class="text-danger small mt-2 ms-1 fw-medium">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted ms-1 small text-uppercase tracking-wider">New Password</label>
                    <input type="password" name="password" class="form-control form-control-lg bg-white bg-opacity-75 shadow-sm" required placeholder="••••••••">
                    @error('password') <div class="text-danger small mt-2 ms-1 fw-medium">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-5">
                    <label class="form-label fw-semibold text-muted ms-1 small text-uppercase tracking-wider">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg bg-white bg-opacity-75 shadow-sm" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-premium w-100 py-3">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
