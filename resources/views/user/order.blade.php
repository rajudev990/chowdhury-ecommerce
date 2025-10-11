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
                                    <a href="javascript:void(0);"
                                        data-id="{{ $item->id }}"
                                        class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-sm transition-all duration-200 viewOrderBtn"
                                        title="View Order">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>


                                    <!-- Invoice -->
                                    <!-- <a href="#"
                                        class="w-8 h-8 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white rounded-full shadow-sm transition-all duration-200"
                                        title="View Invoice">
                                        <i class="fas fa-file-invoice text-xs"></i>
                                    </a> -->
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


<!-- Order Details Modal -->
<div id="orderModal" x-data="{ open: false }" x-show="open"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
    x-transition>
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Header -->
        <div class="bg-gradient-to-r from-cyan-600 to-cyan-500 text-white px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Order Details</h2>
            <button id="closeModal" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-4" id="orderDetails">
            <!-- Invoice Content dynamically added -->
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 bg-gray-50 text-right">
            <button id="printInvoice"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                <i class="fas fa-print mr-1"></i> Print Invoice
            </button>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        // Open Modal and Load Data
        $(document).on('click', '.viewOrderBtn', function() {
            const id = $(this).data('id');
            $('#orderModal').removeClass('hidden');
            $('#orderModal').find('[x-data]').attr('x-data', "{ open: true }");

            $.ajax({
                url: `/order/view/${id}`,
                type: 'GET',
                success: function(res) {
                    let html = `
                    <div class="border-b pb-3 mb-3">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Order #${res.order_id}</h3>
                        <p class="text-gray-600 text-sm">Payment Method: <span class="font-medium capitalize">${res.payment_method}</span></p>
                        <p class="text-gray-600 text-sm">Payment Status: <span class="font-medium">${res.payment_status}</span></p>
                        <p class="text-gray-600 text-sm">Order Status: <span class="font-medium">${res.status}</span></p>
                        <p class="text-gray-600 text-sm">Total: <span class="font-semibold">${res.total} </span></p>
                    </div>

                    <table class="w-full border-collapse border border-gray-200 text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="border px-3 py-2 text-left">Product</th>
                                <th class="border px-3 py-2 text-center">Quantity</th>
                                <th class="border px-3 py-2 text-center">Price</th>
                                <th class="border px-3 py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                    res.order_items.forEach(item => {
                        html += `
                        <tr class="border-t">
                            <td class="border px-3 py-2">${item.product ? item.product.name : 'N/A'}</td>
                            <td class="border px-3 py-2 text-center">${item.quantity}</td>
                            <td class="border px-3 py-2 text-center">${item.price} </td>
                            <td class="border px-3 py-2 text-right">${(item.quantity * item.price).toFixed(2)} </td>
                        </tr>
                    `;
                    });

                    html += `
                        </tbody>
                    </table>
                    <div class="text-right mt-4 text-gray-700">
                        <p><strong>Total:</strong> ${res.total} </p>
                        <p><strong>Paid:</strong> ${res.paid ?? 0} </p>
                        <p><strong>Delivery Charge:</strong> ${res.delivery_charge} </p>
                        ${res.coupon ? `<p><strong>Coupon Discount:</strong> -${res.coupon} </p>` : ''}
                    </div>
                `;

                    $('#orderDetails').html(html);
                }
            });
        });

        // Close Modal
        $('#closeModal').on('click', function() {
            $('#orderModal').addClass('hidden');
            $('#orderDetails').html('');
        });

        // Print Invoice
        $('#printInvoice').on('click', function() {
            const printContent = document.getElementById('orderDetails').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        });
    });
</script>
@endsection