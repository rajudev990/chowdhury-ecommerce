@extends('vendor.layouts.app')

@section('title', 'Revenue')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow rounded-3">

            <!-- Header -->
            <div class="card-header bg-gradient-purple text-white d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <h3 class="mb-2 mb-sm-0">Revenue</h3>
                <div class="bg-white text-dark px-3 py-1 rounded shadow fw-semibold">
                    My Balance: {{ currency() }}{{ number_format($balance,2) }}
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-uppercase text-muted small">
                        <tr class="text-center">
                            <th>SL</th>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price({{currency()}})</th>
                            <th>Total({{currency()}})</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $sl = 1; @endphp
                        @forelse($orders as $order)
                            @foreach($order->orderItems as $item)
                            <tr class="text-center align-middle">
                                <td>{{ $sl++ }}</td>
                                <td class="text-uppercase fw-semibold">{{ $order->order_id }}</td>
                                <td>{{ $item->product->name ?? '-' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ currency() }}{{ number_format($item->price, 2) }}</td>
                                <td class="fw-semibold">{{ currency() }}{{ number_format($item->price * $item->quantity, 2) }}</td>
                                <td>
                                    <span class="badge
                                        @if($order->payment_status === 'paid') bg-success
                                        @elseif($order->payment_status === 'pending') bg-warning text-dark
                                        @else bg-danger @endif">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No revenue found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="d-md-none">
                @php $sl = 1; @endphp
                @forelse($orders as $order)
                    @foreach($order->orderItems as $item)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title mb-0">#{{ $order->order_id }}</h5>
                                <span class="badge
                                    @if($order->payment_status === 'paid') bg-success
                                    @elseif($order->payment_status === 'pending') bg-warning text-dark
                                    @else bg-danger @endif">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                            <p class="mb-1"><strong>SL:</strong> {{ $sl++ }}</p>
                            <p class="mb-1"><strong>Product:</strong> {{ $item->product->name ?? '-' }}</p>
                            <p class="mb-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                            <p class="mb-1"><strong>Price:</strong> {{ currency() }}{{ number_format($item->price,2) }}</p>
                            <p class="mb-0"><strong>Total:</strong> {{ currency() }}{{ number_format($item->price * $item->quantity,2) }}</p>
                        </div>
                    </div>
                    @endforeach
                @empty
                <div class="text-center text-muted py-2">No revenue found.</div>
                @endforelse
            </div>

        </div>
    </div>
</section>
@endsection
