@extends('admin.layouts.app')

@section('title', 'View Order')

@section('content')
<div class="container-fluid py-5" id="printSection">
    <div class="card shadow-lg rounded-3">
        <div class="card-body">

            <!-- Logo & Company Info -->
            <div class="text-center mb-4">
                <img src="{{ Storage::url($setting->header_logo) }}" alt="Company Logo" class="mb-2" style="height: 64px;">
                <h2 class="h4">{{ $setting->title }}</h2>
                <p class="mb-0">Phone: {{ $setting->phone_one }}</p>
                <p class="mb-0">Email: {{ $setting->email_one }}</p>
                <p class="mb-0">Address: {{ $setting->address }}</p>
            </div>

            <!-- Customer & Order Info -->
            <div class="row mb-4">
                <!-- Customer Info -->
                <div class="col-md-6">
                    <h5>Customer Info</h5>
                    <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->user->address ?? 'N/A' }}</p>
                    <p><strong>Delivery Area:</strong> {{ $order->delivery_area ?? 'N/A' }}</p>
                </div>

                <!-- Order Info -->
                <div class="col-md-6 text-md-end">
                    <h5>Order Info</h5>
                    <p><strong>Invoice ID:</strong> {{ $order->order_id }}</p>
                    <p><strong>Total:</strong> {{ currency() }}{{ number_format($order->total,2) }}</p>
                    <p><strong>Paid:</strong> {{ currency() }}{{ number_format($order->paid ?? 0,2) }}</p>
                    <p>
                        <strong>Payment Status:</strong>
                        <select id="payment_status" class="form-select form-select-sm d-inline-block w-auto">
                            <option value="">Select Status</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </p>
                    <p>
                        <strong>Order Status:</strong>
                        <select id="order_status" class="form-select form-select-sm d-inline-block w-auto">
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
            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name ?? 'Product Name' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ currency() }}{{ number_format($item->price,2) }}</td>
                            <td>{{ currency() }}{{ number_format($item->quantity * $item->price,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary Table -->
            <div class="row justify-content-end mb-4">
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Total</th>
                                <td class="text-end">{{ currency() }}{{ number_format($order->total,2) }}</td>
                            </tr>
                            <tr>
                                <th>Paid</th>
                                <td class="text-end">{{ currency() }}{{ number_format($order->paid ?? 0,2) }}</td>
                            </tr>
                            <tr>
                                <th>Due</th>
                                <td class="text-end">{{ currency() }}{{ number_format($order->total - ($order->paid ?? 0),2) }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Charge</th>
                                <td class="text-end">{{ currency() }}{{ number_format($order->delivery_charge,2) }}</td>
                            </tr>
                            <tr>
                                <th>Coupon</th>
                                <td class="text-end">{{ currency() }}{{ number_format($order->coupon ?? 0,2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Print Button -->
            <button id="printBtn" class="btn btn-primary mb-3">
                <i class="fa fa-print me-1"></i> Print
            </button>

        </div>
    </div>
</div>

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

// Print functionality
document.getElementById('printBtn').addEventListener('click', function() {
    let printContents = document.getElementById('printSection').innerHTML;
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
});
</script>
@endsection
