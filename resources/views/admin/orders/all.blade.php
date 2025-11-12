@extends('admin.layouts.app')

@section('title', 'All Orders')

@section('content')
<div class="container-fluid py-4">
    <!-- Card Wrapper -->
    <div class="card shadow-lg rounded-3">
        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <div>
                <h5 class="mb-0">All Orders</h5>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>SL</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment & Status</th>
                            <th>Courier</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-uppercase m-0 font-weight-bold">{{ $order->order_id }}</td>
                            <td>
                                <p class="m-0">{{ $order->user->name ?? 'Guest' }}</p>
                                <p class="m-0 d-flex align-items-center gap-2">
                                    {{ $order->user->phone ?? '' }}
                                    <a href="#" class="text-danger" title="More Info">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </p>

                                <p class="text-muted m-0 small">{{ $order->user->address ?? '' }}</p>
                            </td>
                            <td>
                                <p class="m-0">Total: {{ currency() }}{{ number_format($order->total, 2) }}</p>
                                <p class="m-0">Paid: {{ currency() }}{{ number_format($order->paid, 2) }}</p>
                                <p class="m-0">Due: {{ currency() }}{{ number_format($order->total - $order->paid, 2) }}</p>
                            </td>
                            <td>
                                <p class="m-0">Payment: {{ $order->payment_method ?? 'N/A' }}</p>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-secondary text-white',
                                        'processing' => 'bg-primary text-white',
                                        'on the way' => 'bg-info text-white',
                                        'on hold' => 'bg-warning text-dark',
                                        'completed' => 'bg-success text-white',
                                        'cancelled' => 'bg-danger text-white',
                                    ];
                                @endphp
                                <span class="badge {{ $statusColors[$order->status] ?? 'bg-secondary text-white' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    
                                   <a href=""><span class="badge text-light bg-danger">Pathao</span></a>
                                    
                                   <a href=""><span class="badge bg-warning text-light">RedX</span></a>
                          
                                    <a href=""><span class="badge bg-info text-light">Steadfast</span></a>
                    
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
