@extends('vendor.layouts.app')

@section('title', 'All Orders')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow rounded-3">

            <!-- Header -->
            <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Orders</h5>
            </div>

            <!-- Table (Desktop) -->
            <div class="table-responsive d-none d-md-block">
                <table class="table table-hover mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        @php
                            $statusColors = [
                                'pending' => 'bg-secondary text-white',
                                'processing' => 'bg-primary text-white',
                                'on the way' => 'bg-info text-white',
                                'on hold' => 'bg-warning text-dark',
                                'completed' => 'bg-success text-white',
                                'cancelled' => 'bg-danger text-white',
                            ];
                            $payColors = [
                                'paid' => 'bg-success text-white',
                                'unpaid' => 'bg-danger text-white',
                                'pending' => 'bg-secondary text-white',
                            ];
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-uppercase">{{ $order->order_id }}</td>
                            <td>{{ $order->user->name ?? 'Guest' }}</td>
                            <td>{{ currency() }}{{ number_format($order->total, 2) }}</td>
                            <td class="text-capitalize">{{ $order->payment_method ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary text-white' }}">
                                    {{ \Illuminate\Support\Str::title($order->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $payColors[$order->payment_status] ?? 'bg-secondary text-white' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('vendor.orders.show', $order->id) }}" 
                                   class="btn btn-success btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @if($orders->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center text-muted py-2">No orders found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile (Card View) -->
            <div class="d-md-none">
                @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="card-title mb-0">#{{ $order->order_id }}</h6>
                            <a href="{{ route('vendor.orders.show', $order->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <p class="mb-1"><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                        <p class="mb-1"><strong>Total:</strong> {{ currency() }}{{ number_format($order->total, 2) }}</p>
                        <p class="mb-1"><strong>Payment:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                        <p class="mb-1">
                            <strong>Status:</strong> 
                            <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary text-white' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p class="mb-0">
                            <strong>Payment Status:</strong> 
                            <span class="badge {{ $payColors[$order->payment_status] ?? 'bg-secondary text-white' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                </div>
                @endforeach

                @if($orders->isEmpty())
                <div class="text-center text-muted py-4">No orders found.</div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
