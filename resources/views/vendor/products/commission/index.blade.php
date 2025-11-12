@extends('vendor.layouts.app')

@section('title','Product Commission')

@section('content')

<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg rounded-2 border-0 overflow-hidden">

        <!-- Header -->
        <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Commission</h5>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 60px;">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" style="width: 80px;">Image</th>
                            <th scope="col">Price ({{currency()}})</th>
                            <th scope="col" style="width: 200px;">Commission (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>
                                <img src="{{ Storage::url($product->featured_image_1) }}" alt="Product Image" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <del class="text-muted">{{currency()}}{{ number_format($product->regular_price, 2) }}</del>
                                <span class="ms-2 fw-semibold text-success">{{currency()}}{{ number_format($product->sale_price, 2) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('vendor.product-commission.store') }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @php
                                        $commission = $product->commission ? $product->commission->amount : null;
                                    @endphp
                                    <input type="number" name="commission" class="form-control form-control-sm w-50" placeholder="%" step="0.01" min="0" max="100" value="{{ $commission }}">
                                    <button type="submit" class="btn btn-primary btn-sm ms-2">Save</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-2 text-muted">No Products Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</section>
@endsection

@push('styles')

<style>
.bg-gradient-cyan {
    background: linear-gradient(to right, #06b6d4, #0891b2);
}
</style>

@endpush
