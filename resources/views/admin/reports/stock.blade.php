@extends('admin.layouts.app')

@section('title', 'Order Report')

@section('content')

<div class="p-6 bg-gray-100 min-h-screen">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-boxes"></i> Stock Report
        </h2>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-white p-4 rounded-lg shadow no-print">
        <div>
            <label for="keyword" class="block text-sm font-medium text-gray-600">Keyword</label>
            <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                   class="w-full mt-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-600">Category</label>
            <select name="category_id" class="w-full mt-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Select...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request()->get('category_id') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-600">Start Date</label>
            <input type="date" name="start_date" value="{{ request()->get('start_date') }}"
                   class="w-full mt-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-600">End Date</label>
            <input type="date" name="end_date" value="{{ request()->get('end_date') }}"
                   class="w-full mt-1 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="md:col-span-4 text-right">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Submit</button>
            <a href="{{ route('admin.stock_report') }}" class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Reset</a>
        </div>
    </form>

    <!-- Action Buttons -->
    <div class="flex items-center justify-between mt-6 mb-3">
       <div class="no-print mt-6 flex justify-center">
            {{ $products->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>

        <div class="flex gap-3 no-print">
            <button onclick="printFunction()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center gap-2">
                <i class="fas fa-print"></i> Print
            </button>
            <button id="export-excel-button" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center gap-2">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>

    <!-- Report Table -->
    <div id="content-to-export" class="bg-white p-4 rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">SL</th>
                    <th class="px-4 py-2 border">Product Name</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Stock</th>
                    <th class="px-4 py-2 border">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $stock = 0;
                    $total = 0;
                @endphp
                @foreach($products as $key => $value)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border">{{ $value->name }}</td>
                    <td class="px-4 py-2 border">{{ $value->sale_price }}</td>
                    <td class="px-4 py-2 border">{{ $value->stock }}</td>
                    <td class="px-4 py-2 border">{{ $value->stock * $value->sale_price }}</td>
                </tr>
                @php
                    $stock += $value->stock;
                    $total += $value->stock * $value->sale_price;
                @endphp
                @endforeach
            </tbody>
            <tfoot class="bg-gray-100 font-semibold">
                <tr>
                    <td colspan="3" class="px-4 py-2 border text-right">Total:</td>
                    <td class="px-4 py-2 border">{{ $stock }} Pcs</td>
                    <td class="px-4 py-2 border">{{ $total }} Tk</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <h5 class="font-bold text-gray-700">Total Purchase = {{ $total_purchase ?? 0 }}</h5>
                        <h5 class="font-bold text-gray-700">Total Stock = {{ $total_stock ?? $stock }} Pcs</h5>
                        <h5 class="font-bold text-gray-700">Total Price = {{ $total_price ?? $total }} Tk</h5>
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
            $('#content-to-export table').table2excel({
                exclude: ".no-export",
                name: "Stock Report"
            });
        });
    });
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    table {
        font-size: 16px;
    }
}
</style>
@endsection