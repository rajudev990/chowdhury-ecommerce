@extends('affiliate.layouts.app')

@section('title', 'Withdraw')

@section('content')
<div class="container py-5 min-vh-100">

    <div class="card shadow-lg rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Withdrawal</h5>
            <!-- Withdraw Button -->
            <a href="{{ route('affiliate.withdraw.create') }}" class="btn btn-light fw-medium">
    <i class="fas fa-money-bill me-2"></i> Withdraw
</a>

        </div>

        <!-- Card Body -->
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Amount ({{ currency() }})</th>
                        <th>Payment Method</th>
                        <th>Payment Info</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $withdraw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ currency() }}{{ number_format($withdraw->amount, 2) }}</td>
                            <td>{{ $withdraw->payment_method }}</td>
                            <td>{{ $withdraw->payment_info }}</td>
                            <td>
                                @php
                                    $status = strtolower($withdraw->status);
                                    $badgeClass = match($status) {
                                        'pending' => 'bg-warning text-dark',
                                        'completed' => 'bg-success text-white',
                                        'rejected' => 'bg-danger text-white',
                                        default => 'bg-secondary text-white'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ strtoupper($withdraw->status) }}</span>
                            </td>
                            <td>{{ $withdraw->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-2">No Withdrawals Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
