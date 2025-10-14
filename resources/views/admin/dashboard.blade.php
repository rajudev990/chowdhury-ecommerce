@extends('admin.layouts.app')

@section('title','Dashboard')

@section('content')
<div class="content-header px-4 py-4">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Dashboard</h1>
            <nav class="text-gray-500 text-sm">
                <ol class="flex space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700">Home</a></li>
                    <li>/</li>
                    <li class="text-gray-700 font-semibold">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="content px-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Orders -->
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
                        <h3 class="text-2xl font-bold mt-2">{{ currency() }}{{ $revenue }}</h3>
                    </div>
                    <div class="bg-blue-700 p-3 rounded-full">
                        <i class="fas fa-dollar-sign text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Products</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $products }}</h3>
                    </div>
                    <div class="bg-indigo-700 p-3 rounded-full">
                        <i class="fas fa-box text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-gradient-to-r from-pink-500 to-pink-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Categories</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $categories }}</h3>
                    </div>
                    <div class="bg-pink-600 p-3 rounded-full">
                        <i class="fas fa-tags text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Customers -->
            <div class="bg-gradient-to-r from-teal-500 to-teal-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Customers</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $customers }}</h3>
                    </div>
                    <div class="bg-teal-600 p-3 rounded-full">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- New Customers -->
            <div class="bg-gradient-to-r from-lime-500 to-lime-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">New Customers</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $new_customers }}</h3>
                    </div>
                    <div class="bg-lime-600 p-3 rounded-full">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Reviews</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $reviews }}</h3>
                    </div>
                    <div class="bg-orange-600 p-3 rounded-full">
                        <i class="fas fa-star text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Reviews -->
            <div class="bg-gradient-to-r from-red-500 to-red-400 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Pending Reviews</p>
                        <h3 class="text-2xl font-bold mt-2">{{ $pending_reviews }}</h3>
                    </div>
                    <div class="bg-red-600 p-3 rounded-full">
                        <i class="fas fa-clock text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Shipped Orders -->
            <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Shipped Orders</p>
                        <h3 class="text-2xl font-bold mt-2">0</h3>
                    </div>
                    <div class="bg-cyan-700 p-3 rounded-full">
                        <i class="fas fa-truck text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Refunds -->
            <div class="bg-gradient-to-r from-gray-600 to-gray-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium uppercase">Refunds</p>
                        <h3 class="text-2xl font-bold mt-2">0</h3>
                    </div>
                    <div class="bg-gray-700 p-3 rounded-full">
                        <i class="fas fa-undo text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Stock Alerts -->
            <div class="bg-gradient-to-r from-red-600 to-red-500 text-white p-5 rounded-2xl shadow hover:scale-105 transform transition">
                <div class="flex items-center justify-between">
                    <!-- Stock Alerts Button -->
                    <div>
                        <p class="text-sm font-medium uppercase">Stock Alerts</p>
                        <h3 class="text-2xl font-bold mt-2">
                            <button id="open-stock-modal" class="text-blue-600 hover:underline">Stock</button>
                        </h3>
                    </div>

                    <div class="bg-red-700 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stock Modal -->
<div id="stock-modal" class="fixed inset-0 hidden items-center justify-center z-50">
    <!-- Overlay -->
    <div id="stock-modal-overlay" class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-4xl z-50 overflow-auto max-h-[80vh]">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-xl font-bold">Stock Management</h2>
            <button id="close-stock-modal" class="text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
        </div>

        <div class="p-4 space-y-6">
            <!-- Low Stock Products -->
            <div>
                <h3 class="text-red-600 font-semibold mb-2">Low Stock Products (≤ 10)</h3>
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Product Name</th>
                            <th class="px-4 py-2 border">Available Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $product->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->available_stock }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-4 py-2 text-center text-gray-500">No low-stock products</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Other Products -->
            <div>
                <h3 class="text-blue-600 font-semibold mb-2">Other Products</h3>
                <table class="min-w-full text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Product Name</th>
                            <th class="px-4 py-2 border">Available Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($otherProducts as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $product->name }}</td>
                            <td class="px-4 py-2 border">{{ $product->available_stock }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-4 py-2 text-center text-gray-500">No products found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end p-4 border-t">
            <button id="close-stock-modal-btn" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Close</button>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Open modal
        $('#open-stock-modal').click(function() {
            $('#stock-modal').removeClass('hidden').addClass('flex');
        });

        // Close modal
        $('#close-stock-modal, #close-stock-modal-btn, #stock-modal-overlay').click(function() {
            $('#stock-modal').removeClass('flex').addClass('hidden');
        });
    });
</script>

@endsection