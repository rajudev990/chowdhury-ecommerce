@extends('admin.layouts.app')

@section('title', 'View Order')


@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen position-relative" id="printSection">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl p-6 relative">

            <!-- Logo & Company Info -->
            <div class="text-center mb-6">
                <img src="{{ Storage::url($setting->header_logo) }}" alt="Company Logo" class="mx-auto h-16 mb-2">
                <h2 class="text-2xl font-bold">{{ $setting->title }}</h2>
                <p class="text-gray-600">Phone: {{ $setting->phone_one }}</p>
                <p class="text-gray-600">Email: {{ $setting->email_one }}</p>
                <p class="text-gray-600">Address: {{ $setting->address }}</p>
            </div>

            <!-- Customer Info & Order Info -->
            <div class="flex justify-between mb-6">
                <!-- Customer Info -->
                <div>
                    <h4 class="font-semibold mb-2">Customer Info</h4>
                    <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->user->address ?? 'N/A' }}</p>
                    <p><strong>Delivery Area:</strong> {{ $order->delivery_area ?? 'N/A' }}</p>
                </div>

                <!-- Order Info -->
                <div class="text-right">
                    <h4 class="font-semibold mb-2">Order Info</h4>
                    <p><strong>Invoice ID:</strong> {{ $order->order_id }}</p>
                    <p><strong>Total:</strong> {{currency()}}{{ number_format($order->total,2) }}</p>
                    <p><strong>Paid:</strong> {{currency()}}{{ number_format($order->paid ?? 0,2) }}</p>
                    <p><strong>Payment Status:</strong> 
                        <select id="payment_status" class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select Status</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </p>
                    <p><strong>Order Status:</strong> 
                        <select id="order_status" class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select Status</option>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="on the way" {{ $order->status == 'on the way' ? 'selected' : '' }}>On The Way</option>
                            <option value="on hold" {{ $order->status == 'on hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="courier" {{ $order->status == 'courier' ? 'selected' : '' }}>Courier</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </p>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-3 py-2">#</th>
                            <th class="border px-3 py-2">Product</th>
                            <th class="border px-3 py-2">Qty</th>
                            <th class="border px-3 py-2">Price</th>
                            <th class="border px-3 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="text-center">
                            <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-3 py-2">{{ $item->product->name ?? 'Product Name' }}</td>
                            <td class="border px-3 py-2">{{ $item->quantity }}</td>
                            <td class="border px-3 py-2">{{currency()}}{{ number_format($item->price,2) }}</td>
                            <td class="border px-3 py-2">{{currency()}}{{ number_format($item->quantity * $item->price,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Table -->
            <div class="flex justify-end mb-16">
                <div class="w-1/3">
                    <table class="min-w-full border border-gray-300">
                        <tbody>
                            <tr>
                                <th class="border px-3 py-2 text-left">Total</th>
                                <td class="border px-3 py-2 text-right">{{currency()}}{{ number_format($order->total,2) }}</td>
                            </tr>
                            <tr>
                                <th class="border px-3 py-2 text-left">Paid</th>
                                <td class="border px-3 py-2 text-right">{{currency()}}{{ number_format($order->paid ?? 0,2) }}</td>
                            </tr>
                            <tr>
                                <th class="border px-3 py-2 text-left">Due</th>
                                <td class="border px-3 py-2 text-right">{{currency()}}{{ number_format($order->total - ($order->paid ?? 0),2) }}</td>
                            </tr>
                            <tr>
                                <th class="border px-3 py-2 text-left">Delivery Charge</th>
                                <td class="border px-3 py-2 text-right">{{currency()}}{{ number_format($order->delivery_charge,2) }}</td>
                            </tr>
                            <tr>
                                <th class="border px-3 py-2 text-left">Coupon</th>
                                <td class="border px-3 py-2 text-right">{{currency()}}{{ number_format($order->coupon ?? 0,2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Print Button -->
            <button id="printBtn" 
                class="abosolute bottom-6 left-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 print:hidden">
                Print
            </button>

        </div>
    </div>
</section>

<!-- AJAX for Status Update -->
<script>
document.getElementById('payment_status').addEventListener('change', function() {
    let value = this.value;
    fetch("{{ route('admin.orders.updateStatus', $order->id) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ field: 'payment_status', value: value })
    }).then(res => res.json()).then(data => {
        alert('Payment status updated!');
    });
});

document.getElementById('order_status').addEventListener('change', function() {
    let value = this.value;
    fetch("{{ route('admin.orders.updateStatus', $order->id) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ field: 'status', value: value })
    }).then(res => res.json()).then(data => {
        alert('Order status updated!');
    });
});
</script>
@endsection