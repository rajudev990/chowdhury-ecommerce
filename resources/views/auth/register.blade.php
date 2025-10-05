@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="login-card p-5 shadow-sm rounded-4 bg-white">
                    <h2 class="login-title text-center mb-4">Create Your Account</h2>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" id="registerForm">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                placeholder="John Doe"
                                value="{{ old('name') }}"
                                required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                placeholder="john@example.com"
                                value="{{ old('email') }}"
                                required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    placeholder="Enter your password"
                                    required>
                                <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    id="password_confirmation"
                                    placeholder="Confirm your password"
                                    required>
                                <span class="input-group-text" id="toggleConfirmPassword" style="cursor:pointer;">
                                    <i class="fas fa-eye" id="confirmEyeIcon"></i>
                                </span>
                            </div>
                            <div id="passwordMatchMsg" class="form-text text-danger d-none">Passwords do not match!</div>
                             @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#">Terms & Conditions</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </button>

                        <p class="text-center mt-3">
                            Already have an account? <a href="{{ route('login') }}">Login Now</a>
                        </p>
                    </form>

                    {{-- Password Toggle & Match Check --}}
                    <script>
                        const passwordInput = document.getElementById('password');
                        const confirmInput = document.getElementById('password_confirmation');
                        const eyeIcon = document.getElementById('eyeIcon');
                        const confirmEyeIcon = document.getElementById('confirmEyeIcon');
                        const passwordMsg = document.getElementById('passwordMatchMsg');

                        // Toggle main password
                        document.getElementById('togglePassword').addEventListener('click', function() {
                            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            passwordInput.setAttribute('type', type);
                            eyeIcon.classList.toggle('fa-eye-slash');
                        });

                        // Toggle confirm password
                        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                            const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                            confirmInput.setAttribute('type', type);
                            confirmEyeIcon.classList.toggle('fa-eye-slash');
                        });

                        // Check password match (live)
                        confirmInput.addEventListener('input', function() {
                            if (confirmInput.value !== passwordInput.value) {
                                passwordMsg.classList.remove('d-none');
                            } else {
                                passwordMsg.classList.add('d-none');
                            }
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection