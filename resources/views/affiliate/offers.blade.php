@extends('affiliate.layouts.app')
@section('title', 'My Offers')

@section('content')


<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">My Offers</h2>
        </div>

        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Name</th>
                        <th class="px-4 py-2 border">Image</th>
                        <th class="px-4 py-2 border">Price({{ currency() }})</th>
                        <th class="px-4 py-2 border">Commission (%)</th>
                        <th class="px-4 py-2 border">Action</th>
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
                            <del>{{ currency() }}{{ number_format($product->regular_price, 2) }}</del>
                            <span>{{ currency() }}{{ number_format($product->sale_price, 2) }}</span>
                        </td>
                        <td class="px-4 py-2 border text-center">
                            
                                @php
                                $commission = $product->commission ? $product->commission->amount : null;
                                @endphp

                                {{ currency() }}{{ $commission }}%


                        </td>
                         <td class="px-4 py-2 border">
                            <!-- Copy button for product link -->
                            <button onclick="copyToClipboard('{{ route('product.show', ['slug' => $product->slug, 'affiliate_id' => auth()->guard('affiliate')->user()->id]) }}')" class="bg-green-500 text-white px-3 py-1 rounded">Copy Link</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No Products Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</section>
@endsection

@section('scripts')
<script>
    function copyToClipboard(text) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        alert('Product link copied!');
    }
</script>
@endsection