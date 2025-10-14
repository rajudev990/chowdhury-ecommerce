@extends('vendor.layouts.app')

@section('title', 'Revenue')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

           <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white rounded-t-xl mb-4">
            <h3 class="text-xl font-semibold tracking-wide">Revenue</h3>
            
            
            <div class="mt-2 sm:mt-0 bg-white text-gray-800 px-4 py-2 rounded-lg font-semibold shadow">
                My Balance: {{ currency() }}{{ number_format($balance,2) }}
            </div>
        </div>
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">SL</th>
                            <th class="px-5 py-3">Order ID</th>
                            <th class="px-5 py-3">Product</th>
                            <th class="px-5 py-3">Quantity</th>
                            <th class="px-5 py-3">Price({{currency()}})</th>
                            <th class="px-5 py-3">Total({{currency()}})</th>
                            <th class="px-5 py-3">Payment Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @php $sl = 1; @endphp
                        @foreach($orders as $order)
                            @foreach($order->orderItems as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-5 py-3 text-gray-700 font-medium">{{ $sl++ }}</td>
                                <td class="px-5 py-3 font-semibold text-gray-800 uppercase">{{ $order->order_id }}</td>
                                <td class="px-5 py-3 text-gray-700">{{ $item->product->name ?? '-' }}</td>
                                <td class="px-5 py-3 text-gray-700">{{ $item->quantity }}</td>
                                <td class="px-5 py-3 text-gray-700">{{currency()}}{{ number_format($item->price, 2) }}</td>
                                <td class="px-5 py-3 text-gray-800 font-semibold">{{currency()}}{{ number_format($item->price * $item->quantity, 2) }}</td>
                                <td class="px-5 py-3">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if($order->payment_status === 'paid') bg-green-100 text-green-700
                                        @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                        @if($orders->isEmpty())
                        <tr>
                            <td colspan="7" class="px-5 py-6 text-center text-gray-500">No revenue found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-100">
                @php $sl = 1; @endphp
                @foreach($orders as $order)
                    @foreach($order->orderItems as $item)
                    <div class="p-4 hover:bg-gray-50 transition">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="text-gray-800 font-semibold text-base">#{{ $order->order_id }}</h4>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($order->payment_status === 'paid') bg-green-100 text-green-700
                                @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-1"><span class="font-medium">SL:</span> {{ $sl++ }}</p>
                        <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Product:</span> {{ $item->product->name ?? '-' }}</p>
                        <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Quantity:</span> {{ $item->quantity }}</p>
                        <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Price:</span> {{currency()}}{{ number_format($item->price,2) }}</p>
                        <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Total:</span> {{currency()}}{{ number_format($item->price * $item->quantity,2) }}</p>
                    </div>
                    @endforeach
                @endforeach

                @if($orders->isEmpty())
                <div class="p-6 text-center text-gray-500">No revenue found.</div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
