@extends('affiliate.layouts.app')
@section('title', 'Profile Setting')

@section('content')
<div class="container py-5 min-vh-100">

    <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Profile Settingst</h5>
        </div>

        <!-- Form -->
        <form action="{{ route('affiliate.profile.update') }}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf
            @method('PUT')

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Grid layout -->
            <div class="row g-3">

                <!-- Username -->
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="{{ auth('affiliate')->user()->username }}" required class="form-control">
                </div>

                <!-- First Name -->
                <div class="col-md-6">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" name="fname" id="fname" value="{{ auth('affiliate')->user()->fname }}" required class="form-control">
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" name="lname" id="lname" value="{{ auth('affiliate')->user()->lname }}" required class="form-control">
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ auth('affiliate')->user()->phone }}" required class="form-control">
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ auth('affiliate')->user()->email }}" required class="form-control">
                </div>

                <!-- Website URL -->
                <div class="col-md-6">
                    <label for="website_url" class="form-label">Website URL</label>
                    <input type="text" name="website_url" id="website_url" value="{{ auth('affiliate')->user()->website_url }}" required class="form-control">
                </div>

                <!-- Social Link -->
                <div class="col-md-6">
                    <label for="social_media_link" class="form-label">Social Media Link</label>
                    <input type="text" name="social_media_link" id="social_media_link" value="{{ auth('affiliate')->user()->social_media_link }}" required class="form-control">
                </div>

                <!-- Promotion Method -->
                <div class="col-md-6">
                    <label for="promotion_method" class="form-label">Promotion Method</label>
                    <input type="text" name="promotion_method" id="promotion_method" value="{{ auth('affiliate')->user()->promotion_method }}" required class="form-control">
                </div>

                <!-- Referral ID -->
                <div class="col-md-6">
                    <label for="referal_name_id" class="form-label">Referral ID</label>
                    <input type="text" name="referal_name_id" id="referal_name_id" value="{{ auth('affiliate')->user()->referal_name_id }}" required class="form-control">
                </div>

                <!-- Image Upload -->
                <div class="col-md-6">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control">

                    <!-- Image Preview -->
                    <div class="mt-3">
                        @if(auth('affiliate')->user()->image)
                            <img id="preview-image" src="{{ Storage::url(auth('affiliate')->user()->image) }}" alt="Profile Image" class="img-thumbnail" style="width:120px; height:120px; object-fit:cover;">
                        @else
                            <img id="preview-image" class="img-thumbnail d-none" alt="Preview Image" style="width:120px; height:120px; object-fit:cover;">
                        @endif
                    </div>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="mt-4 text-end">
                <button type="submit" class="btn text-white bg-gradient-purple">
                    <i class="fa fa-edit"></i> Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const preview = document.getElementById('preview-image');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endsection
