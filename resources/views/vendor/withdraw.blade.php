@extends('vendor.layouts.app')

@section('title', 'Withdraw')

@section('content')

<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg rounded-2 border-0 overflow-hidden">

        <!-- Header -->
        <div class="card-header text-white bg-gradient-purple d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Withdraw</h5>
            <a href="{{ route('vendor.withdrawal.create') }}" class="btn btn-light btn-sm px-3">
                <i class="fa fa-wallet me-1"></i> Withdraw
            </a>
        </div>

        <!-- Table -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Requested Amount ({{ currency() }})</th>
                            <th>Commission (%)</th>
                            <th>Payable Amount ({{ currency() }})</th>
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
                            <td>{{ currency() }}{{ number_format($withdraw->request_amount, 2) }}</td>
                            <td>{{ number_format($withdraw->commission, 2) }}%</td>
                            <td>{{ currency() }}{{ number_format($withdraw->payable_amount, 2) }}</td>
                            <td>{{ $withdraw->payment_method }}</td>
                            <td>{{ $withdraw->payment_info }}</td>
                            <td>
                                @php
                                    $badgeClass = match($withdraw->status) {
                                        'pending' => 'bg-warning text-dark',
                                        'completed' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} px-3 py-2">{{ strtoupper($withdraw->status) }}</span>
                            </td>
                            <td>{{ $withdraw->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-2">No Withdrawals Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</section>
@endsection
