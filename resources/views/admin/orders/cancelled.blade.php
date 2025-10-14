@extends('admin.layouts.app')

@section('title', 'Cancelled Orders')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Cancelled Orders</h3>
            </div>

            <!-- Table (Desktop) -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">SL</th>
                            <th class="px-5 py-3">Order ID</th>
                            <th class="px-5 py-3">Customer</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Payment Method</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Payment Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 font-semibold text-gray-800 uppercase">{{ $order->order_id }}</td>
                            <td class="px-5 py-3 text-gray-700">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-5 py-3 text-gray-800 font-semibold">{{currency()}}{{ number_format($order->total, 2) }}</td>
                            <td class="px-5 py-3 text-gray-600 capitalize">{{ $order->payment_method ?? 'N/A' }}</td>

                            <!-- Order Status -->
                            <td class="px-5 py-3">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-gray-100 text-gray-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'on-the-way' => 'bg-indigo-100 text-indigo-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <!-- Payment Status -->
                            <td class="px-5 py-3">
                                @php
                                    $payColors = [
                                        'paid' => 'bg-green-100 text-green-700',
                                        'unpaid' => 'bg-red-100 text-red-700',
                                        'pending' => 'bg-gray-100 text-gray-700',
                                    ];
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $payColors[$order->payment_status] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="w-8 h-8 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full shadow-sm transition">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @if($orders->isEmpty())
                        <tr>
                            <td colspan="8" class="px-5 py-6 text-center text-gray-500">No orders found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile (Card View) -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach($orders as $order)
                <div class="p-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="text-gray-800 font-semibold text-base">#{{ $order->order_id }}</h4>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                class="w-8 h-8 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                        </div>
                    </div>

                    <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Customer:</span> {{ $order->user->name ?? 'Guest' }}</p>
                    <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Total:</span> {{currency()}}{{ number_format($order->total, 2) }}</p>
                    <p class="text-gray-600 text-sm mb-1"><span class="font-medium">Payment:</span> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                    <p class="text-gray-600 text-sm mb-1">
                        <span class="font-medium">Status:</span>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                @endforeach

                @if($orders->isEmpty())
                <div class="p-6 text-center text-gray-500">No orders found.</div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
