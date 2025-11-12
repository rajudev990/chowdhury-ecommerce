@extends('admin.layouts.app')

@section('title', 'Edit Affiliate User')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 900px; overflow: hidden;">

            <!-- Header -->
            <div class="card-header text-white d-flex justify-content-between align-items-center bg-gradient-purple">
                <h5 class="mb-0">Edit Affiliate User</h5>

                @can('view user')
                <a href="{{ route('admin.all-users.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-angle-left me-1"></i> Back
                </a>
                @endcan
            </div>

            <!-- Form Body -->
            <div class="card-body">
                <form method="POST" action="{{ route('admin.all-users.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fname" value="{{ old('fname', $data->fname) }}" class="form-control" required>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lname" value="{{ old('lname', $data->lname) }}" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $data->email) }}" class="form-control" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" class="form-control" required>
                        </div>

                        <!-- Username -->
                        <div class="col-md-6">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" value="{{ old('username', $data->username) }}" class="form-control" required>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Leave blank to keep current password">
                        </div>

                        <!-- Website URL -->
                        <div class="col-md-6">
                            <label class="form-label">Website URL</label>
                            <input type="text" name="website_url" value="{{ old('website_url', $data->website_url) }}" class="form-control">
                        </div>

                        <!-- Social Media Link -->
                        <div class="col-md-6">
                            <label class="form-label">Social Media Link</label>
                            <input type="text" name="social_media_link" value="{{ old('social_media_link', $data->social_media_link) }}" class="form-control">
                        </div>

                        <!-- Promotion Method -->
                        <div class="col-md-6">
                            <label class="form-label">Promotion Method</label>
                            <input type="text" name="promotion_method" value="{{ old('promotion_method', $data->promotion_method) }}" class="form-control">
                        </div>

                        <!-- Referral Name / ID -->
                        <div class="col-md-6">
                            <label class="form-label">Referral Name / ID</label>
                            <input type="text" name="referal_name_id" value="{{ old('referal_name_id', $data->referal_name_id) }}" class="form-control">
                        </div>

                        <!-- Image -->
                        <div class="col-md-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($data->image)
                                <div class="mt-2">
                                    <img src="{{Storage::url( $data->image) }}" alt="User Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                            @endif
                            @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ old('status', $data->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="rejected" {{ old('status', $data->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end pt-4 mt-3 border-top">
                        <button type="submit" class="btn text-white px-4 bg-gradient-purple">
                            <i class="fa fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
@endsection
