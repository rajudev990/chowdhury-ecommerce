@extends('admin.layouts.app')

@section('title','Order Report')

@section('content')
<div class="container py-5">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <h2 class="fw-semibold text-dark mb-0">Order Report</h2>
        <div class="no-print d-flex gap-2">
            <button onclick="printFunction()" class="btn btn-success">
                <i class="fa fa-print"></i> Print
            </button>
            <button id="export-excel-button" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="GET" class="no-print mb-4 bg-white p-4 rounded shadow-sm">
        <div class="row g-3">
            <!-- Keyword -->
            <div class="col-md-3">
                <label class="form-label fw-medium">Keyword</label>
                <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                    class="form-control" placeholder="Search keyword">
            </div>

            <!-- Assign User -->
            <div class="col-md-3">
                <label class="form-label fw-medium">Assign User</label>
                <select name="user_id" class="form-select">
                    <option value="">Select..</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @if(request()->get('user_id') == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Start Date -->
            <div class="col-md-3">
                <label class="form-label fw-medium">Start Date</label>
                <input type="date" name="start_date" value="{{ request()->get('start_date') }}"
                    class="form-control">
            </div>

            <!-- End Date -->
            <div class="col-md-3">
                <label class="form-label fw-medium">End Date</label>
                <input type="date" name="end_date" value="{{ request()->get('end_date') }}"
                    class="form-control">
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-4 d-flex gap-2">
            <button class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.order_report') }}" class="btn btn-danger">Reset</a>
        </div>
    </form>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <div>
            {{ $orders->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>

    <!-- Report Table -->
    <div id="content-to-export" class="bg-white p-3 rounded shadow-sm table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Product</th>
                    <th>Purchase</th>
                    <th>Sale</th>
                    <th>Quantity</th>
                    <th>Total</th>
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
                    <tr>
                        <td>{{ $order->order->order_id ?? '' }}</td>
                        <td>{{ $order->order->user->name ?? '' }}</td>
                        <td>{{ $order->order->user->phone ?? '' }}</td>
                        <td>{{ $order->product->name ?? '' }}</td>
                        <td class="text-end">{{ number_format($order->product->purchase_price ?? 0, 2) }}</td>
                        <td class="text-end">{{ number_format($order->price ?? 0, 2) }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td class="text-end">{{ number_format($sale, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot class="table-light fw-semibold">
                <tr>
                    <td colspan="5" class="text-end">Total</td>
                    <td class="text-end">{{ number_format($total_purchase, 2) }}</td>
                    <td>{{ $total_quantity }}</td>
                    <td class="text-end">{{ number_format($total_sale, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="8" class="text-end ">
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
