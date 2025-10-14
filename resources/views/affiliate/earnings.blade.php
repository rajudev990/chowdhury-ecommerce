@extends('affiliate.layouts.app')

@section('title', 'My Earnings')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">My Earnings</h2>
        </div>

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <!-- Earnings Summary -->
            <div class="flex justify-between">
                <div>
                    <h4 class="font-semibold">Completed Orders</h4>
                    <p class="text-green-500">{{ currency() }}{{ number_format($totalCompletedCommission, 2) }}</p>
                </div>
                <div>
                    <h4 class="font-semibold">Pending Orders</h4>
                    <p class="text-yellow-500">{{ currency() }}{{ number_format($totalPendingCommission, 2) }}</p>
                </div>
            </div>

            <table class="min-w-full border border-gray-200 table-auto mt-2">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Order ID</th>
                        <th class="px-4 py-2 border">Product</th>
                        <th class="px-4 py-2 border">Quantity</th>
                        <th class="px-4 py-2 border">Price({{ currency() }})</th>
                        <!-- <th class="px-4 py-2 border">Payment Status</th> -->
                        <th class="px-4 py-2 border">Commissions({{ currency() }})</th>
                        <th class="px-4 py-2 border">Earning({{ currency() }})</th>
                        <th class="px-4 py-2 border">Order Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        @foreach ($order->orderItems as $orderItem)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $order->order_id }}</td>
                                <td class="px-4 py-2 border">{{ $orderItem->product->name }}</td>
                                <td class="px-4 py-2 border">{{ $orderItem->quantity }}</td>
                                <td class="px-4 py-2 border">{{ currency() }}{{ number_format($orderItem->price, 2) }}</td>
                                <td class="px-4 py-2 border">
                                    {{ currency() }}{{ $orderItem->product->commission->amount }}%
                                </td>
                                <td class="px-4 py-2 border">
                                    @php 
                                    $commision = $orderItem->product->commission->amount;
                                    $price = $orderItem->price * $orderItem->quantity;
                                    $profit = ($commision / 100) * $price;
                                    @endphp
                                    {{ currency() }}{{ number_format($profit,2) }}
                                </td>
                                <!-- <td class="px-4 py-2 border">
                                    <span class="inline-block px-3 py-1 rounded-full text-white text-sm
                                        @if($order->payment_status == 'pending') bg-yellow-500 
                                        @elseif($order->payment_status == 'paid') bg-green-500 
                                        @elseif($order->payment_status == 'unpaid') bg-red-500 
                                        @endif">
                                        {{ strtoupper($order->payment_status) }}
                                    </span>
                                </td> -->

                                <td class="px-4 py-2 border">
                                    <!-- Capitalize text and apply badge styling based on the order status -->
                                    <span class="inline-block px-3 py-1 rounded-full text-white text-sm 
                                        @if($order->status == 'pending') bg-yellow-500 
                                        @elseif($order->status == 'processing') bg-blue-500 
                                        @elseif($order->status == 'on the way') bg-green-500 
                                        @elseif($order->status == 'on hold') bg-orange-500 
                                        @elseif($order->status == 'courier') bg-purple-500 
                                        @elseif($order->status == 'completed') bg-green-500 
                                        @elseif($order->status == 'cancelled') bg-red-500 
                                        @endif">
                                        {{ strtoupper($order->status) }}
                                    </span>

                                </td>

                                
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection