@extends('admin.layouts.app')

@section('title', 'Edit Coupon')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 mx-auto" style="max-width: 700px; overflow: hidden;">

        <!-- Card Header -->
        <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Coupon</h5>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-light btn-sm">
                <i class="fa fa-angle-left me-1"></i> Back
            </a>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.coupons.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="coupon_code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                    <input type="text" name="coupon_code" id="coupon_code" 
                        value="{{ old('coupon_code', $data->coupon_code) }}"
                        class="form-control @error('coupon_code') is-invalid @enderror"
                        placeholder="Enter Coupon Code" required>
                    @error('coupon_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Coupon Amount (%) <span class="text-danger">*</span></label>
                    <input type="number" name="amount" id="amount" 
                        value="{{ old('amount', $data->amount) }}"
                        class="form-control @error('amount') is-invalid @enderror"
                        placeholder="Enter Coupon Amount" required>
                    @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Deactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn text-white bg-gradient-purple">
                        <i class="fa fa-save me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
