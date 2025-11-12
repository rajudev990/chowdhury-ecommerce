@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="container-fluid py-4">
    {{-- Card Wrapper --}}
    <div class="card shadow-lg rounded-3">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Products List</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus me-1"></i> Add Product
            </a>
        </div>

        {{-- Card Body --}}
        <div class="card-body p-0">
            {{-- Responsive Table --}}
            <div class="table-responsive">
                <table class="table  table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                           <th class="px-4 py-2 border">#</th>
                            <th class="px-4 py-2 border">Name</th>
                            <th class="px-4 py-2 border">Category</th>
                            <th class="px-4 py-2 border">SubCategory</th>
                            <th class="px-4 py-2 border">Brand</th>
                            <th class="px-4 py-2 border">Price</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($products as $product)
                        <tr>
                            <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->subCategory->name ?? 'N/A' }}</td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>{{currency()}}{{ number_format($product->regular_price,2) }}</td>
                        <td>
                            <span class="badge {{ $product->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" data-id="{{ $product->id }}" class="btn btn-danger btn-sm delete-btn">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No subcategories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                 <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            if(confirm('Are you sure you want to delete this subcategory?')) {
                document.getElementById('delete-form-' + id)?.submit();
            }
        });
    });
</script>
@endsection
