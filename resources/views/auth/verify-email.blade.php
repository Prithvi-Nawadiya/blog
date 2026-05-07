@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center fade-in-up" style="min-height: 60vh;">
    <div class="col-md-6 col-lg-5">
        <div class="glass-panel p-5 text-center shadow-sm">
            <h3 class="fw-bold mb-3">Verify Your Email</h3>
            <p class="text-muted mb-4 fs-6" style="line-height: 1.6;">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            
            @if (session('success'))
                <div class="alert alert-success mb-4 bg-transparent border-success" style="color: #4ade80;">
                    A new verification link has been sent to your email.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-premium w-100 py-3 mb-3">Resend Verification Email</button>
            </form>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-light w-100 py-2">Log Out</button>
            </form>
        </div>
    </div>
</div>
@endsection
