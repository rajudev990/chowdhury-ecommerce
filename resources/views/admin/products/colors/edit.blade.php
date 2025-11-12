@extends('admin.layouts.app')

@section('title', 'Edit Color')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg rounded-3">
        <!-- Card Header -->
        <div class="card-header text-white bg-gradient-purple">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Color</h5>
                <a href="{{ route('admin.colors.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.colors.update', $color->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Important for update -->

                <!-- Color Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Color Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $color->name) }}"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter color name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Color Code -->
                <div class="mb-3">
                    <label for="code" class="form-label">Color Code</label>
                    <input type="text" name="code" id="code" value="{{ old('code', $color->code) }}"
                        class="form-control @error('code') is-invalid @enderror" placeholder="#ffffff">
                    @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $color->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $color->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-edit me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
