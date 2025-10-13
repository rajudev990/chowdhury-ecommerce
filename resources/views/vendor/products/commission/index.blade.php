@extends('vendor.layouts.app')

@section('title','Product Commission')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Product Commission</h2>
        </div>

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Price</th>
                        <th class="px-4 py-2 border">Commission (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-2 border font-medium">
                            <img src="{{ Storage::url($product->featured_image_1) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td class="px-4 py-2 border">
                            <del>{{ number_format($product->regular_price, 2) }}</del>
                            <span>{{ number_format($product->sale_price, 2) }}</span>
                        </td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('vendor.product-commission.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <!-- Display existing commission if exists, otherwise leave it empty -->
                                @php
                                $commission = $product->commission ? $product->commission->amount : null;
                                @endphp

                                <input type="number" name="commission" class="border p-2 w-24 rounded" placeholder="Enter %" step="0.01" min="0" max="100" value="{{ $commission }}">

                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded ml-2">Save</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No Products Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</section>
@endsection