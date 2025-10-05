@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card p-5 shadow-sm rounded-4 bg-white">
                    <h2 class="login-title text-center mb-4">Create Your Account</h2>

                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="john@example.com"
                                required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="Enter your password" required>
                            <span class="password-toggle" onclick="togglePassword()">👁️</span>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm-password"
                                placeholder="Confirm your password" required>
                            <span class="password-toggle" onclick="toggleConfirmPassword()">👁️</span>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">I agree to the <a href="#">Terms &
                                    Conditions</a></label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </button>

                        <p class="text-center mt-3">
                            Already have an account? <a href="{{ route('login') }}">Login Now</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection