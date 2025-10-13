@extends('vendor.layouts.app')

@section('title','Vendor Products')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Vendor Products</h2>
            <a href="{{ route('vendor.products.create') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-1.5 rounded-lg transition flex items-center gap-1">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
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
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                        <td class="px-4 py-2 border font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-2 border">{{ $product->category->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $product->subCategory->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ $product->brand->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">${{ number_format($product->regular_price,2) }}</td>
                        <td class="px-4 py-2 border text-center">
                            @if($product->status)
                            <span class="text-green-600 font-semibold">Active</span>
                            @else
                            <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border flex gap-2 justify-center">
                            <a href="{{ route('vendor.products.edit',$product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('vendor.products.destroy',$product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-500">No Products Found</td>
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
</section>
@endsection