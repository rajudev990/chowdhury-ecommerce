@extends('layouts.app')
@section('title', 'Track Orders')
@section('content')

<section class="py-5 bg-light">
    <div class="container">
        <!-- Track Form -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4">Track Your Order</h4>
                        <form action="{{ route('track.order') }}" method="GET" data-parsley-validate novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="invoice_id" class="form-label">Invoice ID</label>
                                <input value="{{ request('invoice_id') }}" type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Enter Your Invoice ID" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <p class="text-center mt-3 text-muted">Enter your invoice ID to track your order.</p>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($order))
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <!-- Customer Info -->
                        <div class="d-flex justify-content-between">
                            <div class="mb-3">
                                <strong>Customer Name:</strong> {{ $order->user->name ?? 'Guest' }}<br>
                                <strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}<br>
                                <strong>Address:</strong> {{ $order->user->address ?? 'N/A' }}<br>
                            </div>
                            <div class="mb-3">
                                <strong>Delivery Area:</strong> {{ $order->delivery_area ?? 'N/A' }}<br>
                                <strong>Order Status:</strong>
                                <span class="badge bg-info text-capitalize">{{ $order->status ?? 'N/A' }}</span><br>

                                <strong>Payment Status:</strong>
                                <span class="badge bg-info text-capitalize">{{ $order->payment_status ?? 'N/A' }}</span><br>

                            </div>
                        </div>

                        <!-- Ordered Products -->
                        <h6 class="mt-3 mb-2">Ordered Products</h6>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->product->name ?? 'Product Name' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Summary -->
                        <div class="mt-3">
                            <table class="table table-bordered w-50 float-end">
                                <tbody>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <td>{{ number_format($order->paid ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Due</th>
                                        <td>{{ number_format(($order->total - ($order->paid ?? 0)), 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery Charge</th>
                                        <td>{{ number_format($order->delivery_charge, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Coupon</th>
                                        <td>{{ number_format($order->coupon ?? 0, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-danger fw-bold">Not Founded</p>
        @endif


    </div>
</section>

@endsection