@extends('admin.layouts.app')

@section('title','Product Commission')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="mx-auto" style="max-width: 1200px;">
            <div class="card shadow-lg rounded-3 overflow-hidden">

                <!-- Header -->
                <div class="card-header text-white d-flex justify-content-between align-items-center bg-gradient-purple">
                    <h5 class="mb-0">Product Commission</h5>
                </div>

                <div class="card-body p-0">

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Commission (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $product->name }}</td>
                                    <td>
                                        <img src="{{ Storage::url($product->featured_image_1) }}" alt="Product Image" class="img-thumbnail" style="width:50px; height:50px; object-fit:cover;">
                                    </td>
                                    <td>
                                        <del>{{ currency() }}{{ number_format($product->regular_price, 2) }}</del>
                                        <span>{{ currency() }}{{ number_format($product->sale_price, 2) }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.product-commission.store') }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            @php
                                            $commission = $product->commission ? $product->commission->amount : null;
                                            @endphp

                                            <input type="number" name="commission" class="form-control form-control-sm me-2" placeholder="Enter %" step="0.01" min="0" max="100" value="{{ $commission }}" style="width:100px;">

                                            <button type="submit" class="btn btn-sm bg-gradient-purple text-light">Save</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No Products Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endsection