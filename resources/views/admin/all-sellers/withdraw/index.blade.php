@extends('admin.layouts.app')

@section('title', 'Vendor Withdraw Requests')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        {{-- Card Header --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-gradient-purple text-white">
            <h5 class="mb-0">Withdraw Requests</h5>
        
        </div>

            <!-- Status Buttons -->
            <div class="d-flex flex-wrap gap-2 p-4 border-bottom">
                <button id="pendingBtn"
                    class="btn btn-sm {{ $status == 'pending' ? 'btn-primary' : 'btn-outline-secondary' }}"
                    onclick="filterByStatus('pending')">
                    Pending
                </button>

                <button id="completedBtn"
                    class="btn btn-sm {{ $status == 'completed' ? 'btn-success' : 'btn-outline-secondary' }}"
                    onclick="filterByStatus('completed')">
                    Completed
                </button>

                <button id="rejectedBtn"
                    class="btn btn-sm {{ $status == 'rejected' ? 'btn-danger' : 'btn-outline-secondary' }}"
                    onclick="filterByStatus('rejected')">
                    Rejected
                </button>
            </div>

            <!-- Table -->
            <div class="table-responsive p-4">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Seller</th>
                            <th>Date</th>
                            <th>Request Amount ({{ currency() }})</th>
                            <th>Commissions (%)</th>
                            <th>Payable Amount ({{ currency() }})</th>
                            <th>Payment Method</th>
                            <th>Payment Info</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $withdraw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $withdraw->vendor->name }}</td>
                            <td>{{ $withdraw->created_at->format('d M Y') }}</td>
                            <td>{{ currency() }}{{ number_format($withdraw->request_amount, 2) }}</td>
                            <td>{{ number_format($withdraw->commission, 2) }}%</td>
                            <td>{{ currency() }}{{ number_format($withdraw->payable_amount, 2) }}</td>
                            <td>{{ $withdraw->payment_method }}</td>
                            <td>{{ $withdraw->payment_info }}</td>
                            <td>
                                @if($withdraw->status == 'pending')
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @elseif($withdraw->status == 'completed')
                                    <span class="badge bg-success">COMPLETED</span>
                                @elseif($withdraw->status == 'rejected')
                                    <span class="badge bg-danger">REJECTED</span>
                                @endif
                            </td>
                            <td>
                                <select class="form-select form-select-sm status-select" data-id="{{ $withdraw->id }}">
                                    <option value="pending" {{ $withdraw->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ $withdraw->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="rejected" {{ $withdraw->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>
@endsection


@section('script')
<script>
    // Filter by Status
    function filterByStatus(status) {
        let url = '{{ route('admin.sellers-withdrawal') }}' + '?status=' + status;
        window.location.href = url;
    }

    // Change Status via Dropdown (AJAX)
    $(document).on('change', '.status-select', function() {
        var status = $(this).val();
        var id = $(this).data('id');

        $.ajax({
            url: '{{ route('admin.sellers-withdrawal.updateStatus', ':id') }}'.replace(':id', id),
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    // Use Bootstrap alert instead of plain alert
                    const alertBox = document.createElement('div');
                    alertBox.className = 'alert alert-success position-fixed top-0 end-0 m-3';
                    alertBox.innerHTML = 'Status updated successfully!';
                    document.body.appendChild(alertBox);
                    setTimeout(() => alertBox.remove(), 2000);

                    setTimeout(() => window.location.reload(), 1500);
                }
            }
        });
    });
</script>
@endsection
