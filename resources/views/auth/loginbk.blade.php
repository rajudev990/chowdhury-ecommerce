@extends('layouts.app')
@section('title')
Others Income - Login
@endsection
@section('css')
<style></style>
@endsection
@section('content')
<!-- content -->
<!-- Services Section -->
<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container text-center" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-10 col-12 m-auto section-title">
                <div><span class="description-title">লগইন </span></div>
                <p>
                    আমাদের প্ল্যাটফর্মে কাজ করুন — মোবাইল দিয়ে ভিডিও দেখুন আর ইনকাম করুন!
                    কোনো রিস্ক বা ইনভেস্টমেন্ট ছাড়াই নিজের সময়কে পরিণত করুন নিশ্চিত আয়ে।
                    দ্রুত পেমেন্ট এবং বিশ্বস্ত সাপোর্ট নিয়ে আমরা আছি আপনার পাশে।
                </p>
            </div>
        </div>

    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">

            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8" data-aos="fade-up" data-aos-delay="100">
                        <form method="POST" action="{{ route('login') }}" class="bg-white shadow-lg rounded-4 p-4">
                            @csrf
                            <div class="text-center mb-4">
                                <h3 class="text-success fw-bold">Welcome Back 👋</h3>
                                <p class="text-muted small">Please login to your account</p>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-dark">Email <span class="text-danger">*</span></label>
                                <input id="email" type="email"
                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-dark">Password <span class="text-danger">*</span></label>
                                <input id="password" type="password"
                                    class="form-control rounded-3 @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-dark" for="remember">Remember Me</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">Forgot Password?</a>
                                @endif
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>

    </div>

</section><!-- /Services Section -->


@section('js')
<script>

</script>
@endsection
@endsection