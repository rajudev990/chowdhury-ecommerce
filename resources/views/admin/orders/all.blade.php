@extends('admin.layouts.app')

@section('title', 'All Orders')

@section('content')
<section class="py-8 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-gradient-to-r from-cyan-600 to-cyan-700 px-6 py-4 text-white">
                <h3 class="text-lg sm:text-xl font-semibold tracking-wide">📦 All Orders</h3>
                <p class="text-sm text-cyan-100">Manage & Track all customer orders easily</p>
            </div>

            <!-- Table Wrapper -->
            <div class="w-full overflow-x-auto">
    <table class="table-auto w-auto min-w-full border-collapse divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs whitespace-nowrap">
                <th class="px-5 py-3">SL</th>
                <th class="px-5 py-3">Order ID</th>
                <th class="px-5 py-3">Customer</th>
                <th class="px-5 py-3">Total</th>
                <th class="px-5 py-3">Activities</th>
                <th class="px-5 py-3">Courier</th>
                <th class="px-5 py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @foreach($orders as $order)
            <tr class="hover:bg-gray-50 transition-colors duration-150">
                <td class="px-5 py-3 text-gray-700 font-medium whitespace-nowrap">{{ $loop->iteration }}</td>
                <td class="px-5 py-3 font-semibold text-gray-800 uppercase whitespace-nowrap">{{ $order->order_id }}</td>
                <td class="px-5 py-3 text-gray-700">
                    <p>{{ $order->user->name ?? 'Guest' }}</p>
                    <p>{{ $order->user->phone ?? '' }}</p>
                    <p class="text-xs text-gray-500">{{ $order->user->address ?? '' }}</p>
                </td>
                <td class="px-5 py-3 text-gray-800 font-semibold whitespace-nowrap">
                    <p>Total : {{currency()}}{{ number_format($order->total, 2) }}</p>
                    <p>Paid : {{currency()}}{{ number_format($order->paid, 2) }}</p>
                    <p>Due : {{currency()}}{{ number_format($order->total - $order->paid, 2) }}</p>
                </td>
                <td class="px-5 py-3 text-gray-600 capitalize whitespace-nowrap">
                    Payment: {{ $order->payment_method ?? 'N/A' }}
                    @php
                        $statusColors = [
                            'pending' => 'bg-gray-100 text-gray-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'on the way' => 'bg-indigo-100 text-indigo-700',
                            'on hold' => 'bg-indigo-100 text-indigo-700',
                            'completed' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                        ];
                    @endphp
                    <span class="inline-block px-2 py-1 mt-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-5 py-3 whitespace-nowrap">
                    <div class="flex items-center gap-2 flex-wrap">
                        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border hover:shadow-sm transition">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 12h12l3 3v4h-2a2 2 0 1 1-4 0H9a2 2 0 1 1-4 0H3v-7z"/></svg>
                            <span class="text-xs font-medium">Pathao</span>
                        </button>
                        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border hover:shadow-sm transition">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 0 0-1-1.73L13 2 4 6v10a2 2 0 0 0 1 1.73L11 22l9-4a2 2 0 0 0 1-1.73z"/></svg>
                            <span class="text-xs font-medium">RedX</span>
                        </button>
                        <button class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border hover:shadow-sm transition">
                            <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                            <span class="text-xs font-medium">Steadfast</span>
                        </button>
                    </div>
                </td>
                <td class="px-5 py-3 text-center whitespace-nowrap">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                       class="w-8 h-8 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full shadow-sm transition">
                        <i class="fas fa-eye text-xs"></i>
                    </a>
                </td>
            </tr>
            @endforeach

            @if($orders->isEmpty())
            <tr>
                <td colspan="7" class="px-5 py-6 text-center text-gray-500">No orders found.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>



        </div>
    </div>
</section>
@endsection
