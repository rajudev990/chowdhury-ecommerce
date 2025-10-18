@extends('admin.layouts.app')

@section('title','Order Report')

@section('content')
<div class="p-6">
    <!-- Page Title -->
    <div class="mb-6 border-b pb-3 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Order Report</h2>
        <div class="no-print flex gap-2">
            <button onclick="printFunction()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                <i class="fa fa-print"></i> Print
            </button>
            <button id="export-excel-button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>

    <!-- Filter Form -->
    <!-- Filter Form -->
<form method="GET" class="no-print mb-6 bg-white p-6 rounded shadow">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Keyword -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keyword</label>
            <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Assign User -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Assign User</label>
            <select name="user_id"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select..</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if(request()->get('user_id') == $user->id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Start Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ request()->get('start_date') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- End Date -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" name="end_date" value="{{ request()->get('end_date') }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
    </div>

    <!-- Buttons -->
    <div class="mt-4 flex gap-3">
        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
        <a href="{{ route('admin.order_report') }}"
           class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Reset</a>
    </div>
</form>

    <!-- Pagination & Export -->
    <div class="flex justify-between items-center mb-4 no-print">
        <div>
            {{ $orders->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>

    <!-- Report Table -->
    <div id="content-to-export" class="bg-white p-4 rounded shadow overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-2 border">Invoice</th>
                    <th class="p-2 border">Customer</th>
                    <th class="p-2 border">Phone</th>
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border">Purchase</th>
                    <th class="p-2 border">Sale</th>
                    <th class="p-2 border">quantity</th>
                    <th class="p-2 border">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_purchase = 0;
                    $total_quantity = 0;
                    $total_sale = 0;
                @endphp

                @foreach($orders as $order)
                    @php
                        $purchase = ($order->product->purchase_price ?? 0) * $order->quantity;
                        $sale = ($order->price ?? 0) * $order->quantity;
                        $total_purchase += $purchase;
                        $total_quantity += $order->quantity;
                        $total_sale += $sale;
                    @endphp
                    <tr class="text-gray-700 hover:bg-gray-50">
                        <td class="p-2 border">{{ $order->order->order_id ?? '' }}</td>
                        <td class="p-2 border">{{ $order->order->user->name ?? '' }}</td>
                        <td class="p-2 border">{{ $order->order->user->phone ?? '' }}</td>
                        <td class="p-2 border">{{ $order->product->name ?? '' }}</td>
                        <td class="p-2 border text-right">{{ number_format($order->product->purchase_price ?? 0, 2) }}</td>
                        <td class="p-2 border text-right">{{ number_format($order->price ?? 0, 2) }}</td>
                        <td class="p-2 border text-center">{{ $order->quantity }}</td>
                        <td class="p-2 border text-right">{{ number_format($sale, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot class="bg-gray-50 font-semibold">
                <tr>
                    <td colspan="5" class="p-2 border text-right">Total</td>
                    <td class="p-2 border text-right">{{ number_format($total_purchase, 2) }}</td>
                    <td class="p-2 border text-center">{{ $total_quantity }}</td>
                    <td class="p-2 border text-right">{{ number_format($total_sale, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="p-3 text-center">
                        <p>Total Purchase = <strong>{{ number_format($total_purchase, 2) }}</strong></p>
                        <p>Total Sales = <strong>{{ number_format($total_sale, 2) }}</strong></p>
                        <p>Total Profit = <strong>{{ number_format($total_sale - $total_purchase, 2) }}</strong></p>
                    </td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>

@endsection


@section('script')
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
    function printFunction() {
        window.print();
    }

    $(document).ready(function() {
        $('#export-excel-button').on('click', function() {
            var contentToExport = $('#content-to-export').html();
            var tempElement = $('<div>');
            tempElement.html(contentToExport);
            tempElement.find('table').table2excel({
                exclude: ".no-export",
                name: "Order Report"
            });
        });
    });
</script>
@endsection