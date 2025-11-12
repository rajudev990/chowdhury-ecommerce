@extends('vendor.layouts.app')
@section('title', 'Profile Setting')

@section('content')
<div class="container py-5 min-vh-100 d-flex justify-content-center align-items-start">
    <div class="card shadow-lg rounded-3 w-100" style="max-width: 600px;">

        <!-- Header -->
        <div class="card-header bg-gradient-purple text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Profile Settings</h5>
        </div>

        <!-- Form -->
        <form action="{{ route('vendor.profile.update') }}" method="POST" enctype="multipart/form-data" class="card-body">
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
                <input type="text" name="name" id="name" value="{{ auth('vendor')->user()->name }}"
                    class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ auth('vendor')->user()->email }}"
                    class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ auth('vendor')->user()->phone }}"
                    class="form-control @error('phone') is-invalid @enderror" required>
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
                <div class="mt-3 text-center">
                    @if(auth()->user()->image)
                        <img id="preview-image" src="{{ Storage::url(auth()->user()->image) }}" 
                             class="img-thumbnail" style="width:120px; height:120px; object-fit:cover;" alt="Profile Image">
                    @else
                        <img id="preview-image" class="img-thumbnail d-none" style="width:120px; height:120px; object-fit:cover;" alt="Preview Image">
                    @endif
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-purple d-flex text-light align-items-center gap-2">
                    <i class="fa fa-edit"></i> Update
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
