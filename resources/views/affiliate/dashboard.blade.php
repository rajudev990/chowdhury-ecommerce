@extends('affiliate.layouts.app')

@section('title','Dashboard')

@section('content')


<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <h1 class="h3 fw-bold text-dark mb-2 mb-md-0">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('affiliate.dashboard') }}">Home</a></li>
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
                        <h4 class="fw-bold">{{ $totalOrderCount }}</h4>
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
                        <h4 class="fw-bold">{{ currency() }}{{ number_format($totalPendingCommission, 2) }}</h4>
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
                        <h4 class="fw-bold">{{ currency() }}{{ number_format($totalCompletedCommission, 2) }}</h4>
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
                        <h4 class="fw-bold">{{ currency() }}{{ number_format($totalPendingCommission + $totalCompletedCommission, 2) }}</h4>
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
                        <p class="mb-1 small text-uppercase">Withdraw</p>
                        <h4 class="fw-bold">{{ currency() }}{{ number_format($withdraw, 2) }}</h4>
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
                        <p class="mb-1 small text-uppercase">Balance</p>
                        <h4 class="fw-bold">{{ currency() }}{{ number_format($balance, 2) }}</h4>
                    </div>
                    <div class="bg-dark bg-opacity-25 p-3 rounded-circle">
                        <i class="fas fa-tags fs-5"></i>
                    </div>
                </div>
            </div>
        </div>

      

    </div>
</div>

@endsection
