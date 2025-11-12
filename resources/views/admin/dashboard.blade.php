@extends('admin.layouts.app')

@section('title','Dashboard')

@section('content')

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <h1 class="h3 fw-bold text-dark mb-2 mb-md-0">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4">

        <!-- Total Orders -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-gradient-purple shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Total Orders</p>
                        <h4 class="fw-bold">{{ $orders }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-shopping-cart fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Pending Orders</p>
                        <h4 class="fw-bold">{{ $pending_orders }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-hourglass-half fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Completed Orders</p>
                        <h4 class="fw-bold">{{ $complete_orders }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-check-circle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Revenue</p>
                        <h4 class="fw-bold">{{ currency() }}{{ $revenue }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-dollar-sign fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-indigo shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Products</p>
                        <h4 class="fw-bold">{{ $products }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-box fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-pink shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Categories</p>
                        <h4 class="fw-bold">{{ $categories }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-tags fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-teal shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Customers</p>
                        <h4 class="fw-bold">{{ $customers }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-users fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-orange shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Reviews</p>
                        <h4 class="fw-bold">{{ $reviews }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-star fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Alerts -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-danger shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-1 small text-uppercase">Stock Alerts</p>
                        <button id="open-stock-modal" class="btn btn-light btn-sm fw-bold">View</button>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-exclamation-triangle fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Stock Modal -->
<div class="modal fade" id="stock-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Stock Management</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="text-danger fw-semibold mb-2">Low Stock Products (≤ 10)</h6>
        <table class="table table-bordered table-sm align-middle mb-4">
          <thead class="table-light">
            <tr><th>Product Name</th><th>Available Stock</th></tr>
          </thead>
          <tbody>
            @forelse($lowStockProducts as $product)
            <tr><td>{{ $product->name }}</td><td>{{ $product->available_stock }}</td></tr>
            @empty
            <tr><td colspan="2" class="text-center text-muted">No low-stock products</td></tr>
            @endforelse
          </tbody>
        </table>

        <h6 class="text-primary fw-semibold mb-2">Other Products</h6>
        <table class="table table-bordered table-sm align-middle">
          <thead class="table-light">
            <tr><th>Product Name</th><th>Available Stock</th></tr>
          </thead>
          <tbody>
            @forelse($otherProducts as $product)
            <tr><td>{{ $product->name }}</td><td>{{ $product->available_stock }}</td></tr>
            @empty
            <tr><td colspan="2" class="text-center text-muted">No products found</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function(){
    $('#open-stock-modal').click(function(){ $('#stock-modal').modal('show'); });
});
</script>
@endsection