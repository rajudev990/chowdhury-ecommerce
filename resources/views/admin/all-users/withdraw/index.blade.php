@extends('admin.layouts.app')

@section('title', 'Affiliate Withdraw Requests')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Withdraw Requests</h2>
        </div>

        <!-- Status Buttons -->
        <div class="flex space-x-4 p-6">
            <button id="pendingBtn"
                class="px-4 py-2 rounded-md {{ $status == 'pending' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                onclick="filterByStatus('pending')">Pending</button>

            <button id="completedBtn"
                class="px-4 py-2 rounded-md {{ $status == 'completed' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                onclick="filterByStatus('completed')">Completed</button>

            <button id="rejectedBtn"
                class="px-4 py-2 rounded-md {{ $status == 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-700' }}"
                onclick="filterByStatus('rejected')">Rejected</button>
        </div>


        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Amount</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Payment Info</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Action</th>
                    </tr>
                </thead>
                <tbody id="withdrawalTableBody">
                    @foreach ($withdrawals as $withdraw)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $withdraw->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 border">{{ number_format($withdraw->amount, 2) }} {{currency()}}</td>
                        <td class="px-4 py-2 border">{{ $withdraw->payment_method }}</td>
                        <td class="px-4 py-2 border">{{ $withdraw->payment_info }}</td>
                        <td class="px-4 py-2 border">
                            <span class="inline-block px-3 py-1 rounded-full text-white text-sm
                                @if($withdraw->status == 'pending') bg-yellow-500 
                                @elseif($withdraw->status == 'completed') bg-green-500 
                                @elseif($withdraw->status == 'rejected') bg-red-500 
                                @endif">
                                {{ strtoupper($withdraw->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">
                            <select class="status-select" data-id="{{ $withdraw->id }}">
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
</section>

@endsection

@section('script')
<script>
    // Filter by Status
    function filterByStatus(status) {
        let url = '{{ route('admin.marketer-withdraw.index') }}' + '?status=' + status;
        window.location.href = url;
    }

    // Change Status via Dropdown
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
            success: function(response) {
                if (response.success) {
                    alert('Status updated successfully.');
                    window.location.reload();
                }
            }
        });
    });
</script>
@endsection

