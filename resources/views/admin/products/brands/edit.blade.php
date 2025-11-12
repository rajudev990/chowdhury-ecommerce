@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 700px; overflow: hidden;">

            {{-- Header --}}
            <div class="card-header bg-gradient-purple" style="background:bg-gradient-purple;">
                <div class="d-flex justify-content-between align-items-center text-white">
                    <h5 class="mb-0 fw-semibold">Edit Brand</h5>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-light btn-sm">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>

            {{-- Body --}}
            <div class="card-body p-4">
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Brand Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Brand Name 
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" 
                            value="{{ old('name', $brand->name) }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter brand name" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="mb-3">
                        <label for="logo" class="form-label fw-medium">Brand Logo</label>
                        <input type="file" name="logo" id="logo"
                            class="form-control @error('logo') is-invalid @enderror">
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($brand->logo)
                            <div class="mt-3">
                                <img src="{{Storage::url($brand->logo) }}" 
                                    alt="Brand Logo" width="100" class="border rounded shadow-sm">
                            </div>
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <label for="status" class="form-label fw-medium">Status</label>
                        <select name="status" id="status" 
                            class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="border-top pt-3 text-end">
                        <button type="submit" class="btn text-white bg-gradient-purple">
                            <i class="fa fa-edit me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
