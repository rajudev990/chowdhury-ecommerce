@extends('admin.layouts.app')

@section('title', 'Payment Gateway Setup')

@section('content')
<div class="container py-5">

    <!-- Bkash Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Bkash Setup</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bkash.update', $bkash->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Bkash App Key <span class="text-danger">*</span></label>
                        <input type="text" name="bkash_app_key" value="{{ old('bkash_app_key', $bkash->bkash_app_key) }}"
                            class="form-control @error('bkash_app_key') is-invalid @enderror" placeholder="Enter Bkash App Key" required>
                        @error('bkash_app_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bkash Secret Key <span class="text-danger">*</span></label>
                        <input type="text" name="bkash_secret_key" value="{{ old('bkash_secret_key', $bkash->bkash_secret_key) }}"
                            class="form-control @error('bkash_secret_key') is-invalid @enderror" placeholder="Enter Bkash Secret Key" required>
                        @error('bkash_secret_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bkash Username <span class="text-danger">*</span></label>
                        <input type="text" name="bkash_username" value="{{ old('bkash_username', $bkash->bkash_username) }}"
                            class="form-control @error('bkash_username') is-invalid @enderror" placeholder="Enter Bkash Username" required>
                        @error('bkash_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bkash Password <span class="text-danger">*</span></label>
                        <input type="text" name="bkash_password" value="{{ old('bkash_password', $bkash->bkash_password) }}"
                            class="form-control @error('bkash_password') is-invalid @enderror" placeholder="Enter Bkash Password" required>
                        @error('bkash_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', $bkash->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $bkash->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update Bkash</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Nagad Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update Nagad Setup</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.nagad.update', $nagad->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nagad App Key <span class="text-danger">*</span></label>
                        <input type="text" name="nagad_app_key" value="{{ old('nagad_app_key', $nagad->nagad_app_key) }}"
                            class="form-control @error('nagad_app_key') is-invalid @enderror" placeholder="Enter Nagad App Key" required>
                        @error('nagad_app_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nagad Secret Key <span class="text-danger">*</span></label>
                        <input type="text" name="nagad_secret_key" value="{{ old('nagad_secret_key', $nagad->nagad_secret_key) }}"
                            class="form-control @error('nagad_secret_key') is-invalid @enderror" placeholder="Enter Nagad Secret Key" required>
                        @error('nagad_secret_key')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nagad Username <span class="text-danger">*</span></label>
                        <input type="text" name="nagad_username" value="{{ old('nagad_username', $nagad->nagad_username) }}"
                            class="form-control @error('nagad_username') is-invalid @enderror" placeholder="Enter Nagad Username" required>
                        @error('nagad_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nagad Password <span class="text-danger">*</span></label>
                        <input type="text" name="nagad_password" value="{{ old('nagad_password', $nagad->nagad_password) }}"
                            class="form-control @error('nagad_password') is-invalid @enderror" placeholder="Enter Nagad Password" required>
                        @error('nagad_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', $nagad->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $nagad->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update Nagad</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SSLcommerz Setup -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Update SSLcommerz Setup</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.sslcz.update', $sslcz->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">SSLcz Store ID <span class="text-danger">*</span></label>
                        <input type="text" name="sslcz_store_id" value="{{ old('sslcz_store_id', $sslcz->sslcz_store_id) }}"
                            class="form-control @error('sslcz_store_id') is-invalid @enderror" placeholder="Enter SSLcz Store ID" required>
                        @error('sslcz_store_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SSLcz Password <span class="text-danger">*</span></label>
                        <input type="text" name="sslcz_store_password" value="{{ old('sslcz_store_password', $sslcz->sslcz_store_password) }}"
                            class="form-control @error('sslcz_store_password') is-invalid @enderror" placeholder="Enter SSLcz Password" required>
                        @error('sslcz_store_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SSLcz Sandbox <span class="text-danger">*</span></label>
                        <select name="sslcommerz_sandbox" class="form-select @error('sslcommerz_sandbox') is-invalid @enderror">
                            <option value="live" {{ old('sslcommerz_sandbox', $sslcz->sslcommerz_sandbox ?? '') == 'live' ? 'selected' : '' }}>Live</option>
                            <option value="test" {{ old('sslcommerz_sandbox', $sslcz->sslcommerz_sandbox ?? '') == 'test' ? 'selected' : '' }}>Test</option>
                        </select>
                        @error('sslcommerz_sandbox')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', $sslcz->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $sslcz->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn text-white bg-gradient-purple"><i class="fa fa-edit me-1"></i> Update SSLcz</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
