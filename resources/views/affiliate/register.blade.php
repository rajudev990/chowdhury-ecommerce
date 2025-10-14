@extends('layouts.app')
@section('title','Affiliate Register Form')

@section('content')
<section class="affiliate-registration py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                <div class="affiliate-form p-5 shadow-sm rounded-4 bg-white">
                    <h2 class="affiliate-title mb-4 text-center">Affiliate Program Registration</h2>

                    <form action="{{ route('affiliate.register.submit') }}" method="POST" id="affiliateForm">
                        @csrf

                        {{-- Display Errors --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Personal Information -->
                        <h4 class="mb-3">Personal Information</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input name="fname" type="text" class="form-control" id="firstName" placeholder="John" required value="{{ old('fname') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input name="lname" type="text" class="form-control" id="lastName" placeholder="Doe" required value="{{ old('lname') }}">
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="john@example.com" required value="{{ old('email') }}">
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Phone</label>
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="+8801XXXXXXXXX" required value="{{ old('phone') }}">
                            </div>
                        </div>

                        <!-- Account Information -->
                        <h4 class="mb-3">Account Information</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control" id="username" placeholder="Choose a username" required value="{{ old('username') }}">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                                <span onclick="togglePassword('password', this)"
                                    class="position-absolute top-50 end-0 px-3 cursor-pointer text-gray-500">👁️</span>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
                                <span onclick="togglePassword('password_confirmation', this)"
                                    class="position-absolute top-50 end-0 px-3 cursor-pointer text-gray-500">👁️</span>
                            </div>

                        </div>

                        <!-- Affiliate Details -->
                        <h4 class="mb-3">Affiliate Details</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="website" class="form-label">Website / Blog URL</label>
                                <input name="website_url" type="url" class="form-control" id="website" placeholder="https://example.com" required value="{{ old('website_url') }}">
                            </div>
                            <div class="col-12">
                                <label for="social" class="form-label">Social Media Links</label>
                                <input name="social_media_link" type="text" class="form-control" id="social" placeholder="Facebook / Instagram / YouTube" value="{{ old('social_media_link') }}">
                            </div>
                            <div class="col-12">
                                <label for="promoMethod" class="form-label">Promotion Method</label>
                                <select name="promotion_method" class="form-select" id="promoMethod" required>
                                    <option value="">Select method</option>
                                    <option value="blog" {{ old('promotion_method') == 'blog' ? 'selected' : '' }}>Blog/Website</option>
                                    <option value="youtube" {{ old('promotion_method') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                    <option value="social" {{ old('promotion_method') == 'social' ? 'selected' : '' }}>Social Media</option>
                                    <option value="email" {{ old('promotion_method') == 'email' ? 'selected' : '' }}>Email Marketing</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="referrer" class="form-label">Referrer (Optional)</label>
                                <input name="referal_name_id" type="text" class="form-control" id="referrer" placeholder="Referrer ID or Name" value="{{ old('referal_name_id') }}">
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#">Terms & Conditions</a> of the Affiliate Program.
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-user-plus me-2"></i> Register as Affiliate
                        </button>

                        <!-- Already Registered -->
                        <div class="text-center mt-3">
                            <p class="text-dark">
                                Already registered?
                                <a href="{{ route('affiliate.login') }}" class="text-decoration-none fw-semibold">
                                    Login here
                                </a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    function togglePassword(fieldId, el) {
        const input = document.getElementById(fieldId);
        if (input.type === 'password') {
            input.type = 'text';
            el.textContent = '🙈';
        } else {
            input.type = 'password';
            el.textContent = '👁️';
        }
    }

    // Confirm password validation before submit
    document.getElementById('affiliateForm').addEventListener('submit', function(e) {
        const pass = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        if (pass !== confirm) {
            e.preventDefault();
            alert('Password and Confirm Password do not match!');
        }
    });
</script>
@endsection