@extends('admin.layouts.app')

@section('title', 'Affiliate Withdraw Requests')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 mx-auto" style="overflow: hidden; max-width: 1200px;">

            <!-- Header -->
            <div class="card-header bg-gradient-purple text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Affiliate Withdraw Requests</h5>
            </div>

            <!-- Status Filter -->
            <div class="p-4 d-flex gap-3">
                <button class="btn {{ $status == 'pending' ? 'btn-primary' : 'btn-outline-primary' }}" 
                    onclick="filterByStatus('pending')">Pending</button>

                <button class="btn {{ $status == 'completed' ? 'btn-success' : 'btn-outline-success' }}" 
                    onclick="filterByStatus('completed')">Completed</button>

                <button class="btn {{ $status == 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}" 
                    onclick="filterByStatus('rejected')">Rejected</button>
            </div>

            <!-- Table -->
            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount ({{ currency() }})</th>
                            <th>Payment Method</th>
                            <th>Payment Info</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdrawals as $withdraw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $withdraw->created_at->format('d M Y') }}</td>
                            <td>{{ currency() }}{{ number_format($withdraw->amount, 2) }}</td>
                            <td>{{ $withdraw->payment_method }}</td>
                            <td>{{ $withdraw->payment_info }}</td>
                            <td>
                                <span class="badge 
                                    @if($withdraw->status == 'pending') bg-warning 
                                    @elseif($withdraw->status == 'completed') bg-success 
                                    @elseif($withdraw->status == 'rejected') bg-danger 
                                    @endif">
                                    {{ strtoupper($withdraw->status) }}
                                </span>
                            </td>
                            <td>
                                <select class="form-select status-select" data-id="{{ $withdraw->id }}">
                                    <option value="pending" {{ $withdraw->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $withdraw->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="rejected" {{ $withdraw->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-muted py-3">No withdraw requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // Filter by status
    function filterByStatus(status) {
        window.location.href = '{{ route('admin.marketer-withdraw.index') }}' + '?status=' + status;
    }

    // Change status dynamically via AJAX
    $(document).on('change', '.status-select', function() {
        var status = $(this).val();
        var id = $(this).data('id');

        $.ajax({
            url: '{{ route('admin.marketer-withdraw.updateStatus', ':id') }}'.replace(':id', id),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            beforeSend: function() {
                // Optional: show a loader or disable dropdown
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Status updated successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 1200);
                } else {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Server error occurred.', 'error');
            }
        });
    });
</script>
@endsection
