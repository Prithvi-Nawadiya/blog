@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3">Forgot your password?</h4>
            <p class="text-muted">Enter your email address and we'll send you a link to reset your password.</p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <button class="btn btn-primary">Send reset link</button>
            </form>
        </div>
    </div>
</div>
@endsection
