@extends('vendor.layouts.app')

@section('title', 'Withdraw')

@section('content')
<section class="p-5 bg-gray-100 min-h-screen">
    <div class="mx-auto max-w-7xl bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Withdraw</h2>

            <!-- Withdraw Button (Right aligned) -->
            <a href="{{ route('vendor.withdrawal.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">
                Withdraw
            </a>
        </div>


        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Requested Amount({{ currency() }})</th>
                        <th class="px-4 py-2 border">Commission(%)</th>
                        <th class="px-4 py-2 border">Payable Amount({{ currency() }})</th>
                        <th class="px-4 py-2 border">Payment Method</th>
                        <th class="px-4 py-2 border">Payment Info</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $withdraw)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ currency() }}{{ number_format($withdraw->request_amount, 2) }}</td>
                        <td class="px-4 py-2 border">{{ number_format($withdraw->commission, 2) }}%</td>
                        <td class="px-4 py-2 border">{{ currency() }}{{ number_format($withdraw->payable_amount, 2) }}</td>
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
                        <td class="px-4 py-2 border">{{ $withdraw->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No Withdrawals Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection