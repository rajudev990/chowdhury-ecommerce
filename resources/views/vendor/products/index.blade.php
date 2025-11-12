@extends('vendor.layouts.app')

@section('title','Products')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow rounded-3 overflow-hidden">

            <!-- Header -->
            <div class="card-header bg-gradient-purple d-flex justify-content-between align-items-center text-white">
                <h4 class="mb-0">Products</h4>
                <a href="{{ route('vendor.products.create') }}" class="btn btn-light text-cyan-600 d-flex align-items-center gap-1">
                    <i class="fa fa-plus"></i> Add Product
                </a>
            </div>

            <!-- Table -->
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-uppercase text-muted small">
                        <tr class="text-center align-middle">
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                            <td class="text-start">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>{{ $product->subCategory->name ?? 'N/A' }}</td>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                            <td>{{ currency() }}{{ number_format($product->regular_price,2) }}</td>
                            <td>
                                @if($product->status)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('vendor.products.edit',$product->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('vendor.products.destroy',$product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-2">No Products Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
