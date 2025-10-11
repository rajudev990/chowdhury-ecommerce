@extends('user.layouts.app')
@section('title', 'Orders List')

@section('content')
<section class="py-6 px-3 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-cyan-600 px-6 py-4 text-white">
                <h3 class="text-xl font-semibold tracking-wide">Orders List</h3>
            </div>

            <!-- Table for large screens -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 font-semibold uppercase tracking-wider text-xs">
                            <th class="px-5 py-3">Sl</th>
                            <th class="px-5 py-3">Order ID</th>
                            <th class="px-5 py-3">Total Amount</th>
                            <th class="px-5 py-3">Paid Amount</th>
                            <th class="px-5 py-3">Payment Method</th>
                            <th class="px-5 py-3">Order Status</th>
                            <th class="px-5 py-3">Payment Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($orders as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-5 py-3 text-gray-700 font-medium">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 text-gray-800 font-medium">{{ $item->order_id }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $item->total }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $item->paid ?? '0.00' }}</td>
                            <td class="px-5 py-3 text-gray-700 capitalize">{{ $item->payment_method }}</td>
                           <td class="px-5 py-3">
                                @if($item->status === 'pending')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full">
                                        Pending
                                    </span>
                                @elseif($item->status === 'processing')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                        Processing
                                    </span>
                                @elseif($item->status === 'completed')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Completed
                                    </span>
                                @elseif($item->status === 'cancelled')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Cancelled
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                @endif
                            </td>

                            <!-- <td class="px-5 py-3 text-gray-600 capitalize bg-info badge">{{ $item->status }}</td> -->
                            <!-- <td class="px-5 py-3 text-gray-600 capitalize bg-success badge">{{ $item->payment_status }}</td> -->

                             <td class="px-5 py-3">
                                @if($item->status === 'pending')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full">
                                        Pending
                                    </span>
                                @elseif($item->status === 'processing')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                        Processing
                                    </span>
                                @elseif($item->status === 'completed')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Completed
                                    </span>
                                @elseif($item->status === 'cancelled')
                                    <span class="px-2.5 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Cancelled
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                        {{ ucfirst($item->payment_status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-3 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <!-- View Order -->
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200"
                                        title="View Order">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    <!-- Invoice -->
                                    <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full shadow-sm transition-all duration-200"
                                        title="View Invoice">
                                        <i class="fas fa-file-invoice text-xs"></i>
                                    </a>
                                </div>
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