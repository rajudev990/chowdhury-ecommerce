@extends('admin.layouts.app')

@section('title', 'Update Pixels')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 900px; overflow: hidden;">

        <!-- Card Header -->
        <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Pixels</h5>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.pixel.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="pixel_name" class="form-label">Pixel Name <span class="text-danger">*</span></label>
                        <input type="text" name="pixel_name" id="pixel_name"
                            value="{{ old('pixel_name', $data->pixel_name) }}"
                            class="form-control @error('pixel_name') is-invalid @enderror"
                            placeholder="Enter Pixel Name" required>
                        @error('pixel_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="pixel_id" class="form-label">Pixel ID <span class="text-danger">*</span></label>
                        <input type="text" name="pixel_id" id="pixel_id"
                            value="{{ old('pixel_id', $data->pixel_id) }}"
                            class="form-control @error('pixel_id') is-invalid @enderror"
                            placeholder="Enter Pixel ID" required>
                        @error('pixel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="pixel_code" class="form-label">Pixel Code <span class="text-danger">*</span></label>
                        <input type="text" name="pixel_code" id="pixel_code"
                            value="{{ old('pixel_code', $data->pixel_code) }}"
                            class="form-control @error('pixel_code') is-invalid @enderror"
                            placeholder="Enter Pixel Code" required>
                        @error('pixel_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-edit me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
