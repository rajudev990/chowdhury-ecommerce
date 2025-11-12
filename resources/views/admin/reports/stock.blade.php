@extends('admin.layouts.app')

@section('title', 'Order Report')

@section('content')

<div class="container-fluid py-5 bg-light min-vh-100">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold text-secondary d-flex align-items-center gap-2">
            <i class="fas fa-boxes"></i> Stock Report
        </h2>
    </div>
    <!-- Filter Form -->
    <form method="GET" class="row g-3 bg-white p-4 rounded-3 shadow-sm no-print">
        <div class="col-md-3">
            <label for="keyword" class="form-label">Keyword</label>
            <input type="text" name="keyword" value="{{ request()->get('keyword') }}"
                   class="form-control" placeholder="Search...">
        </div>

        <div class="col-md-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="">Select...</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request()->get('category_id') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" value="{{ request()->get('start_date') }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" value="{{ request()->get('end_date') }}"
                   class="form-control">
        </div>

        <div class="col-12 text-end mt-2">
            <button type="submit" class="btn btn-primary px-4 me-2">Submit</button>
            <a href="{{ route('admin.stock_report') }}" class="btn btn-danger px-4">Reset</a>
        </div>
    </form>

    <!-- Action Buttons -->
    <div class="d-flex align-items-center justify-content-between mt-5 mb-3">
        <div class="no-print mt-4">
           {{ $products->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
        </div>

        <div class="d-flex gap-2 no-print">
            <button onclick="printFunction()" class="btn btn-success d-flex align-items-center gap-2">
                <i class="fas fa-print"></i> Print
            </button>
            <button id="export-excel-button" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>

    <!-- Report Table -->
    <div id="content-to-export" class="bg-white p-4 rounded-3 shadow-sm table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $stock = 0;
                    $total = 0;
                @endphp
                @foreach($products as $key => $value)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->sale_price }}</td>
                    <td>{{ $value->stock }}</td>
                    <td>{{ $value->stock * $value->sale_price }}</td>
                </tr>
                @php
                    $stock += $value->stock;
                    $total += $value->stock * $value->sale_price;
                @endphp
                @endforeach
            </tbody>
            <tfoot class="table-light fw-semibold">
                <tr>
                    <td colspan="3" class="text-end">Total:</td>
                    <td>{{ $stock }} Pcs</td>
                    <td>{{ $total }} Tk</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center py-4">
                        <h5 class="fw-bold text-secondary mb-1">Total Purchase = {{ $total_purchase ?? 0 }}</h5>
                        <h5 class="fw-bold text-secondary mb-1">Total Stock = {{ $total_stock ?? $stock }} Pcs</h5>
                        <h5 class="fw-bold text-secondary mb-0">Total Price = {{ $total_price ?? $total }} Tk</h5>
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
