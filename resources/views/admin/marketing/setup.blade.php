@extends('admin.layouts.app')

@section('title', 'Update Marketing Information')

@section('content')
<div class="container py-5">

    <!-- Facebook Pixel Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Facebook Pixel Setting</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.facebook.update', $facebook->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Facebook Pixel ID <span class="text-danger">*</span></label>
                        <input type="text" name="facebook_id" value="{{ old('facebook_id', $facebook->facebook_id) }}"
                            class="form-control @error('facebook_id') is-invalid @enderror" placeholder="Enter Facebook Pixel ID" required>
                        @error('facebook_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Facebook Pixel Status <span class="text-danger">*</span></label>
                        <select name="facebook_status" class="form-select @error('facebook_status') is-invalid @enderror">
                            <option value="1" {{ old('facebook_status', $facebook->facebook_status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('facebook_status', $facebook->facebook_status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                        @error('facebook_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Google Analytics Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Google Analytics Setting</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.google.update', $google->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tracking ID <span class="text-danger">*</span></label>
                        <input type="text" name="google_id" value="{{ old('google_id', $google->google_id) }}"
                            class="form-control @error('google_id') is-invalid @enderror" placeholder="Enter Tracking ID" required>
                        @error('google_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Google Analytics Status <span class="text-danger">*</span></label>
                        <select name="google_status" class="form-select @error('google_status') is-invalid @enderror">
                            <option value="1" {{ old('google_status', $google->google_status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('google_status', $google->google_status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                        @error('google_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Google Tag Manager Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Google Tag Manager Setting</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.tag-manager.update', $tagManager->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tag Manager ID <span class="text-danger">*</span></label>
                        <input type="text" name="tag_id" value="{{ old('tag_id', $tagManager->tag_id) }}"
                            class="form-control @error('tag_id') is-invalid @enderror" placeholder="Enter Tag Manager ID" required>
                        @error('tag_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tag Manager Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status', $tagManager->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="deactive" {{ old('status', $tagManager->status ?? '') == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
