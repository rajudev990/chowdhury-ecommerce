@extends('affiliate.layouts.app')
@section('title', 'My Earnings')

@section('content')
<div class="container py-5 min-vh-100">

    <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">My Earnings</h5>
        </div>

        <!-- Card Body -->
        <div class="card-body">

            <!-- Earnings Summary -->
            <div class="d-flex justify-content-between mb-4">
                <div>
                    <h6 class="fw-semibold">Completed Orders</h6>
                    <p class="text-success">{{ currency() }}{{ number_format($totalCompletedCommission, 2) }}</p>
                </div>
                <div>
                    <h6 class="fw-semibold">Pending Orders</h6>
                    <p class="text-warning">{{ currency() }}{{ number_format($totalPendingCommission, 2) }}</p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price ({{ currency() }})</th>
                            <th>Commissions (%)</th>
                            <th>Earning ({{ currency() }})</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $orderItem->product->name }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>{{ currency() }}{{ number_format($orderItem->price, 2) }}</td>
                                    <td>{{ $orderItem->product->commission->amount }}%</td>
                                    <td>
                                        @php 
                                            $commission = $orderItem->product->commission->amount;
                                            $price = $orderItem->price * $orderItem->quantity;
                                            $profit = ($commission / 100) * $price;
                                        @endphp
                                        {{ currency() }}{{ number_format($profit, 2) }}
                                    </td>
                                    <td>
                                        @php
                                            $status = strtolower($order->status);
                                            $badgeClass = match($status) {
                                                'pending' => 'bg-warning text-dark',
                                                'processing' => 'bg-primary text-white',
                                                'on the way' => 'bg-success text-white',
                                                'on hold' => 'bg-secondary text-white',
                                                'courier' => 'bg-purple text-white', // custom class if needed
                                                'completed' => 'bg-success text-white',
                                                'cancelled' => 'bg-danger text-white',
                                                default => 'bg-secondary text-white'
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ strtoupper($order->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                         <tr>
                            <td colspan="9" class="text-center text-muted">No earnings found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
