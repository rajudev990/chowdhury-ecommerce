@extends('vendor.layouts.app')

@section('title','Dashboard')

@section('content')

<div class="content-header px-4 py-4">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Dashboard</h1>
            <nav class="text-gray-500 text-sm">
                <ol class="flex space-x-2">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<section class="content px-4 py-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Total Orders -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Total Orders</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $orders }}</h3>
                    </div>
                    <div class="bg-purple-700 p-3 rounded-full">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Pending Orders</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $pending_orders }}</h3>
                    </div>
                    <div class="bg-yellow-600 p-3 rounded-full">
                        <i class="fas fa-hourglass-half text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-gradient-to-r from-green-600 to-green-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Completed Orders</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $complete_orders }}</h3>
                    </div>
                    <div class="bg-green-700 p-3 rounded-full">
                        <i class="fas fa-check-circle text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Revenue</p>
                        <h3 class="text-2xl font-bold mt-2">${{ number_format($revenue, 2) }}</h3>
                    </div>
                    <div class="bg-blue-700 p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-white text-xl"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection