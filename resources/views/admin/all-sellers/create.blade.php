@extends('admin.layouts.app')

@section('title', 'Add Vendor Sellers')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 900px;">

            <!-- Header -->
            <div class="card-header text-white bg-gradient-purple">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-semibold">Add Vendor Sellers</h4>
                    <a href="{{ route('admin.all-sellers.index') }}" 
                       class="btn btn-light btn-sm text-dark fw-semibold d-inline-flex align-items-center gap-1">
                        <i class="fa fa-angle-left"></i> Back
                    </a>
                </div>
            </div>

            <!-- Form Body -->
            <div class="card-body p-4">
                <form method="POST" action="{{ route('admin.all-sellers.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Shop Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Shop Name</label>
                            <input type="text" name="shop_name" value="{{ old('shop_name') }}" class="form-control" placeholder="Enter shop name">
                            @error('shop_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter phone number">
                            @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Enter address">
                            @error('address')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="form-control" placeholder="Enter city">
                            @error('city')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Country</label>
                            <input type="text" name="country" value="{{ old('country') }}" class="form-control" placeholder="Enter country">
                            @error('country')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Postal Code -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control" placeholder="Enter postal code">
                            @error('postal_code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Enter short description">{{ old('description') }}</textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @error('logo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Banner -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Banner</label>
                            <input type="file" name="banner" class="form-control">
                            @error('banner')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                            </select>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end pt-4 border-top mt-4">
                        <button type="submit" class="btn btn-sm text-white bg-gradient-purple px-4">
                            <i class="fa fa-save me-1"></i> Save
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>


  <!-- Name -->
                    <!-- <div>
                        <label class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div> -->
  <!-- Shop Name -->
                    

                    <!-- Shop Slug -->
                    <!-- <div>
                        <label class="block text-gray-700 font-medium mb-1">Shop Slug</label>
                        <input type="text" name="shop_slug" value="{{ old('shop_slug') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-cyan-500 focus:ring-0 outline-none">
                        @error('shop_slug')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div> -->
@endsection
