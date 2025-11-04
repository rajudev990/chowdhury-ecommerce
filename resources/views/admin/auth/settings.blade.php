@extends('admin.layouts.app')
@section('title', 'Profile Setting')

@section('content')

<div class="container py-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <!-- Header -->
        <div class="card-header text-white bg-gradient-purple">
            <h5 class="mb-0">Profile Settings</h5>
        </div>
        <!-- Form -->
        <form action="{{ route('admin.profile.settings.update') }}" method="POST" enctype="multipart/form-data" class="card-body">
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

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name"
                    value="{{ auth('admin')->user()->name }}"
                    required
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                    value="{{ auth('admin')->user()->email }}"
                    required
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone"
                    value="{{ auth('admin')->user()->phone }}"
                    required
                    class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') is-invalid @enderror">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Image Preview -->
                <div class="mt-3">
                    @if(auth('admin')->user()->image)
                    <img id="preview-image" src="{{ Storage::url(auth('admin')->user()->image) }}" alt="Profile Image"
                        class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                    <img id="preview-image" class="d-none img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;" alt="Preview Image">
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn text-white bg-gradient-purple">
                    <i class="fa fa-edit me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

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

@endsection