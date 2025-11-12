@extends('affiliate.layouts.app')
@section('title', 'Password Update')

@section('content')
<div class="container py-5 min-vh-100">

    <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Update Password</h5>
        </div>

        <!-- Form -->
        <form action="{{ route('affiliate.password.update') }}" method="POST" class="card-body">
            @csrf
            @method('POST')

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
                <div class="col-md-12">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" name="current_password" id="current_password" required
                            class="form-control @error('current_password') is-invalid @enderror">
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePassword('current_password', this)">👁️</span>
                        @error('current_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- First Name -->
                <div class="col-md-12">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password" required
                            class="form-control @error('new_password') is-invalid @enderror">
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePassword('new_password', this)">👁️</span>
                        @error('new_password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-12">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                            class="form-control @error('new_password_confirmation') is-invalid @enderror">
                        <span class="input-group-text bg-white" style="cursor:pointer;" onclick="togglePassword('new_password_confirmation', this)">👁️</span>
                        @error('new_password_confirmation')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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
</script>
@endsection